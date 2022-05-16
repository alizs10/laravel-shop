<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function all()
    {
        $payments = Payment::all();
        return view('admin.market.payment.index', $payments);
    }
    public function online()
    {
        return view('admin.market.payment.online');
    }
    public function offline()
    {
        return view('admin.market.payment.offline');
    }
    public function atDoor()
    {
        return view('admin.market.payment.at-door');
    }
}
