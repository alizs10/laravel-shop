<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
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
        $provinces = Province::all();

        $delivery_methods = Delivery::where('status', 1)->get();
        return view('app.shipping', compact('user', 'provinces', 'order', 'delivery_methods'));
    }
}
