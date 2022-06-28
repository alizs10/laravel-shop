<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Market\Delivery;
use App\Models\Market\Order;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    public function index(Order $order)
    {
        $user = Auth::user();
        if ($user->id != $order->user_id) {
            return false;
        }
        $provinces = Province::all();

        $delivery_methods = Delivery::where('status', 1)->get();
        return view('app.shipping', compact('user', 'provinces', 'order', 'delivery_methods'));
    }

    public function selectAddress(Order $order, Address $address)
    {
        $user = Auth::user();

        if ($user->id != $order->user_id || $user->id != $address->user_id) {
            return false;
        }

        $order->update([
            'address_id' => $address->id,
            'address_object' => $address
        ]);

        return response()->json([
            'status' => true
        ]);
    }

    public function selectDelivery(Order $order, Delivery $delivery)
    {
        $user = Auth::user();

        if ($user->id != $order->user_id) {
            return false;
        }

        $order->update([
            'delivery_id' => $delivery->id,
            'delivery_object' => $delivery,
            'delivery_amount' => $delivery->amount,
        ]);

        $pay_price = $order->order_final_amount + $order->delivery_amount;

        return response()->json([
            'status' => true,
            'delivery_amount' => price_formater($delivery->amount),
            'pay_price' => price_formater($pay_price)
        ]);
    }
}
