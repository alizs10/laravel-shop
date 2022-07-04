<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\CartServices;
use App\Http\Services\EmailServices;
use App\Models\Opt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()) {
            return redirect()->route('app.home');
        }

        $redirect = [
            "status" => false,
            "url" => ""
        ];
        $user = false;
        $vcode = false;
        $code = false;
        $email = false;
        $token = false;
        $message = '';

        if ($request->has('back_url')) {
            $redirect['status'] = true;
            $redirect['url'] = $request->get('back_url');
        }

        // login
        if ($request->get('user') == 'true') {
            $user = true;
            $email = $request->email;
            $is_user_exists = User::where("email", $request->email)->first();
            $user = !empty($is_user_exists) ? true : false;
            $message = !$user ? 'این کاربر در سیستم وجود ندارد' : '';
        }
        // vcode
        if ($request->get('vcode') == 'true') {
            if ($request->get('token')) {
                $opt = Opt::where(['token' => $request->get('token'), 'used' => 0])->first();

                if (!empty($opt)) {
                    $email = $opt->identifier;
                    $token = $opt->token;
                    $message = 'کد تایید به ایمیل شما ارسال شد';
                    $vcode = true;
                } else {
                    $message = 'توکن شما معتبر نمی باشد';
                }
            }
        }
        // set passwords when code is checked
        if ($request->get('code') == 'checked') {
            if ($request->get('token')) {
                $opt = Opt::where([
                    'token' => $request->get('token'),
                    'used' => 0,
                ])->latest()->first();

                if (!empty($opt)) {
                    $email = $opt->identifier;
                    $token = $opt->token;

                    if ($opt->created_at < Carbon::now()->subMinutes(5)->toDateTimeString()) {
                        $email = false;
                        $token = false;
                        $message = 'توکن شما منقضی شده است';
                    }
                    $code = 'checked';
                } else {
                    $message = 'توکن شما معتبر نمی باشد';
                }
            }
        }

        // message
        if (session()->get('message')) {
            $message = session()->get('message');
        }

        return view('auth.index', compact('user', 'vcode', 'code', 'email', 'token', 'message'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $credentials = $request->only(['email', 'password']);
        $result = Auth::attempt($credentials);

        if ($result) {
            $cart_services = new CartServices();
            $cart_services->moveCartItems();
            if (session('back_url')) {
                $back_url = session()->pull('back_url');
                if (session('move_cart_items')) {
                    $cartServices = new CartServices();
                    $cartServices->moveCartItems();
                    session()->remove('move_cart_items');
                }
                return redirect($back_url);
            }
            return redirect()->route('app.home');
        }

        return redirect(route('auth.index') . '?user=true&email=' . $request->email)->with(
            'message',
            'ایمیل یا کلمه عبور شما اشتباه می باشد'
        );
    }

    public function loginOrRegister($credentials)
    {
        $user = User::where("email", $credentials->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $credentials->name,
                'email' => $credentials->email,
                'provider_id' => $credentials->id,
                'email_verified_at' => now()
            ]);
        }

        $result = Auth::loginUsingId($user->id);
        if ($result) {

            if ($result) {
                $cart_services = new CartServices();
                $cart_services->moveCartItems();
                if (session('back_url')) {
                    $back_url = session()->pull('back_url');
                    if (session('move_cart_items')) {
                        $cartServices = new CartServices();
                        $cartServices->moveCartItems();
                        session()->remove('move_cart_items');
                    }
                    return redirect($back_url);
                }
                return redirect()->route('app.home');
            }
            return redirect()->route('app.home');
        }

        return redirect()->route('auth.index')->with(
            'message',
            'مشکلی پیش آمده دوباره امتحان کنید'
        );
    }

    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::where("email", $request->email)->first();

        if (!$user || (empty($user->email_verified_at) && empty($user->password)) || (!empty($user->email_verified_at) && empty($user->password))) {

            if (!$user) {
                $user = $this->registerEmail($request->email);
            }

            if ($user) {
                $token = $this->sendVerificationCode($user);

                if ($token) {
                    return redirect(route('auth.index') . '?vcode=true&token=' . $token);
                }
            }
        }

        return redirect(route('auth.index') . '?user=true&email=' . $user->email);
    }


    public function registerEmail($email)
    {
        $user = User::create([
            'email' => $email,
        ]);

        return $user;
    }

    public function sendVerificationCode($user)
    {
        $verification_code = mt_rand(100000, 999999);
        $token = Hash::make(Str::random(64));
        $opt = Opt::create([
            'identifier' => $user->email,
            'user_id' => $user->id,
            'code' => $verification_code,
            'token' => $token
        ]);

        EmailServices::SendVCode($user->email, $verification_code);

        return $opt ? $token : false;
    }

    public function checkVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'vcode' => 'required|array|size:6',
            'vcode.*' => 'required|string|max:1',
            'token' => 'required|string'
        ]);

        $vcodeArr = $request->vcode;
        $verification_code = "";
        foreach ($vcodeArr as $vcode) {
            $verification_code .= $vcode;
        }

        $opt = Opt::where(["identifier" => $request->email, 'token' => $request->token, 'used' => 0])->first();

        if (empty($opt)) {
            return redirect(route('auth.index') . '?token=' . $request->token);
        }

        if ($verification_code === $opt->code) {
            $opt->update(['used' => 1]);
            $newToken = Str::random(64);
            $newOpt = Opt::create([
                'identifier' => $opt->identifier,
                'user_id' => $opt->user_id,
                'code' => '0',
                'token' => $newToken
            ]);

            return redirect(route('auth.index') . '?code=checked&email=' . $opt->identifier . '&token=' . $newToken)->with(
                'message',
                'برای تکمیل ثبت نام، کلمه عبور خود را تعیین کنید'
            );
        }

        return redirect(route('auth.index') . '?vcode=true&email=' . $opt->identifier . '&token=' . $opt->token)->with(
            'message',
            'کد تایید صحیح نمی باشد'
        );
    }

    public function setPasswords(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => [
                'required', 'confirmed', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'token' => 'required|string',
        ]);

        $opt = Opt::where(["identifier" => $request->email, 'token' => $request->token, 'used' => 0])->first();
        if (empty($opt)) {
            return redirect(route('auth.index'))->with(
                'message' , 'توکن شما نامعتبر است'
            );
        }
        $opt->update(['used' => 1]);
        $opt->user()->update([
            'email_verified_at' => now(),
            'password' => Hash::make($request->password)
        ]);
        
    
        $result = Auth::loginUsingId($opt->user_id);
        if ($result) {
            if ($result) {
                $cart_services = new CartServices();
                $cart_services->moveCartItems();
                if (session('back_url')) {
                    $back_url = session()->pull('back_url');
                    if (session('move_cart_items')) {
                        $cartServices = new CartServices();
                        $cartServices->moveCartItems();
                        session()->remove('move_cart_items');
                    }
                    return redirect($back_url);
                }
                return redirect()->route('app.home');
            }
            return redirect()->route('app.home');
        }

        return redirect()->route('auth.index');
    }

    public function logout()
    {
        if (Auth::user()) {
            Auth::logout();
        }

        return redirect()->route('app.home');
    }

    public function sendVCodeAgain()
    {

        $email = request()->get('email');
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false
            ]);
        }

        $user = User::where("email", $email)->first();
        if ($user) {
            $isVCodeSent = $this->sendVerificationCode($user);
            if ($isVCodeSent) {
                return response()->json([
                    'status' => true
                ]);
            }
        }


        return response()->json([
            'status' => false
        ]);
    }

    public function forgotPassword($email)
    {
        $user = User::where(['email' => $email])->first();
        if ($user) {
            $isVCodeSent = $this->sendVerificationCode($user);

            if ($isVCodeSent) {
                return redirect(route('auth.index') . '?user=false&vcode=' . $isVCodeSent . '&email=' . $user->email);
            }
        }

        return redirect()->route('auth.index')->withErrors([
            'email' => 'کاربری با این ایمیل وجود ندارد'
        ]);
    }

    public function changePasswordForm()
    {
        return view('auth.change-password-form');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => [
                'required', 'confirmed', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);
        $user = Auth::user();

        if(!Hash::check($request->old_password, $user->password))
        {
            return redirect()->route('auth.change-password-form')->withErrors([
                'old_password' => 'کلمه عبور فعلی شما صحیح نمی باشد'
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);


        return redirect()->route('app.user.profile');
    }


    // login using google

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        return $this->loginOrRegister($user);
    }
}
