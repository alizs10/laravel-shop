<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $provinces = Province::all();
        return view('app.shipping', compact('user', 'provinces'));
    }
}
