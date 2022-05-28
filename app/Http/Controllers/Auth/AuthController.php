<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index');
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
                    return response([
                        'message' => 'verification code sent successfully',
                        'status' => false
                    ], 200);
                }
            }


            return response([
                'message' => 'user does not exists',
                'status' => false
            ], 200);
        }

        return response([
            'message' => 'user exists',
            'status' => true
        ], 200);
    }
}
