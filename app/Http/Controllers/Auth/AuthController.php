<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\EmailServices;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()) {
            return redirect()->route('app.home');
        }

        $user_login_status = false;
        if ($request->get('user')) {
            $user_login_status = $request->get('user');
        }
        return view('auth.index', compact('user_login_status'));
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
            return redirect()->route('app.home');
        }

        return redirect(route('auth.index') . '?user=true&email=' . $request->email)->with(
            'message',
            'ایمیل یا کلمه عبور شما اشتباه می باشد'
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
                $isVCodeSent = $this->sendVerificationCode($user);

                if ($isVCodeSent) {
                    return redirect(route('auth.index') . '?user=false&vcode=' . $isVCodeSent . '&email=' . $user->email);
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

    public function setPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string',
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers(), 'max:16', 'confirmed'],
        ]);

        $user = User::where("remember_token", $request->token)->first();
        if ($user) {
            $user->update([
                "password" => Hash::make($request->password),
                "remember_token" => null
            ]);
            Auth::loginUsingId($user->id);
            return redirect()->route('app.home');
        }


        return redirect()->back()->with(
            'message', 'اطلاعات شما نادرست می باشد'
        );
    }


    public function sendVerificationCode($user)
    {
        $verification_code = mt_rand(100000, 999999);
        $user->update(['verification_code' => $verification_code]);

        EmailServices::SendVCode($user->email, $verification_code);

        return true;
    }

    public function checkVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'vcode' => 'required|array|size:6',
            'vcode.*' => 'required|string|max:1'
        ]);

        $vcodeArr = $request->vcode;
        $verification_code = "";
        foreach ($vcodeArr as $vcode) {
            $verification_code .= $vcode;
        }

        $user = User::where("email", $request->email)->first();

        if ($verification_code === $user->verification_code) {
            $token = Hash::make(Str::random(64));
            $user->update([
                'email_verified_at' => now(),
                'verification_code' => null,
                'remember_token' => $token
            ]);


            return redirect(route('auth.index') . '?user=false&vcode=2&email=' . $user->email . '&token=' . $token)->with(
                'message',
                'برای تکمیل ثبت نام، کلمه عبور خود را تعیین کنید'
            );
        }

        return redirect(route('auth.index') . '?user=false&vcode=1&email=' . $user->email)->with(
            'message',
            'کد تایید صحیح نمی باشد'
        );
    }

    public function logout() {
        if(Auth::user())
        {
            Auth::logout();
        }

        return redirect()->route('app.home');
    }
}
