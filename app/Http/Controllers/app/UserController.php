<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Http\Requests\app\AddressRequset;
use App\Http\Requests\app\UserProfileRequest;
use App\Models\Address;
use App\Models\Market\Order;
use App\Models\Province;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //profile
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
        return redirect()->back();
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

    //orders

    public function orders(Request $request)
    {
        // 0 => still, 1 => proccessing, 2 => delivered, 3 => canceled, 4 => returned
        $order_types_array = [0, 1, 2, 3, 4];
        $orders_type = 0;
        if ($request->has('type')) {
            $orders_type = in_array($request->get('type'), $order_types_array) ? $request->get('type') : 0;
        }


        $user = Auth::user();
        $orders = $user->orders()->where('order_status', $orders_type)->get();
        return view('app.orders', compact('orders', 'orders_type'));
    }

    public function orderDetails(Order $order)
    {
        return view('app.order-details', compact('order'));
    }

    public function factor(Order $order)
    {
        return view('app.factor', compact('order'));
    }

    //favorites


    public function favorites()
    {
        $user = Auth::user();
        $favorites = $user->favorites;
        return view('app.favorites', compact('favorites'));
    }

    //tickets

    public function tickets()
    {
        $user = Auth::user();
        $tickets = $user->tickets;

        return view('app.tickets', compact('tickets'));
    }

    public function showTicket(Ticket $ticket)
    {
        return view('app.ticket', compact('ticket'));
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
