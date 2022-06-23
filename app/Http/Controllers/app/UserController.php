<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Http\Requests\app\UserProfileRequest;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('app.profile', compact('user'));
    }

    public function profileUpdate(UserProfileRequest $request,User $user)
    {
        if ($user->id != Auth::user()->id) {
            return redirect('app.user.profile');
        }

        $inputs = $request->all();
        $user->update($inputs);

        return redirect()->route('app.user.profile');
        
    }

    public function addresses()
    {
        $user = Auth::user();
        $provinces = Province::all();
        return view('app.addresses', compact('user', 'provinces'));
    }

    public function getCities(Province $province)
    {
        $cities = $province->cities;
        return response()->json([
            'cities' => $cities
        ]);
    }
}
