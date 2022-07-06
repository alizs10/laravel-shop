<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Market\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Order $order)
    {
        return view('app.payment', compact('order'));
    }

    public function result()
    {
        return view('app.payment-result');
    }
}
