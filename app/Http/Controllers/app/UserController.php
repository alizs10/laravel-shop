<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('app.profile', compact('user'));
    }

    public function addresses()
    {
        $user = Auth::user();
        return view('app.addresses', compact('user'));
    }
}
