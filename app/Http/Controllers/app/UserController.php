<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Http\Requests\app\AddressRequset;
use App\Http\Requests\app\UserProfileRequest;
use App\Models\Address;
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

    public function profileUpdate(UserProfileRequest $request, User $user)
    {
        if ($user->id != Auth::user()->id) {
            return redirect('app.user.profile');
        }

        $inputs = $request->all();
        $user->update($inputs);

        return redirect()->route('app.user.profile');
    }

    //addresses

    public function addresses()
    {
        $user = Auth::user();
        $provinces = Province::all();
        return view('app.addresses', compact('user', 'provinces'));
    }

    public function addressesStore(AddressRequset $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;

        Address::create($inputs);
        return redirect()->route('app.user.addresses');
    }

    public function addressesChangeStatus(Address $address)
    {
        $user = Auth::user();
        if ($user->id != $address->user_id) {
            return redirect()->route('app.user.addresses');
        }

        $defaultAddress = $user->addresses()->where('status', 1)->first();
        if (!empty($defaultAddress)) {
            if ($address->id == $defaultAddress->id) {
                return response()->json([
                    'status' => $address->status == 1 ? true : false,
                ]);
            }

            $defaultAddress->update(['status' => 0]);
        }

        $address->update(['status' => 1]);
        return response()->json([
            'status' => $address->status == 1 ? true : false,
        ]);
    }

    public function addressesDestroy(Address $address)
    {
        $user = Auth::user();
        if ($user->id != $address->user_id) {
            return redirect()->route('app.user.addresses');
        }

        $address->delete();
        return redirect()->route('app.user.addresses');
    }
    //provinces and cities
    public function getCities(Province $province)
    {
        $cities = $province->cities;
        return response()->json([
            'cities' => $cities
        ]);
    }
}
