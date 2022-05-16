<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function all()
    {
        $page = "کل پرداخت ها";
        $payments = Payment::all();
        return view('admin.market.payment.index', compact('payments', 'page'));
    }
    public function online()
    {
        $page = "پرداخت های آنلاین";
        $payments = Payment::where('type' , 0)->get();
        return view('admin.market.payment.index', compact('payments', 'page'));
    }
    public function offline()
    {
        $page = "پرداخت های آفلاین";
        $payments = Payment::where('type' , 1)->get();
        return view('admin.market.payment.index', compact('payments', 'page'));
    }
    public function cash()
    {
        $page = "پرداخت های در محل";
        $payments = Payment::where('type' , 2)->get();
        return view('admin.market.payment.index', compact('payments', 'page'));
    }

    public function cancel(Payment $payment)
    {
        $payment->status = 2;
        $payment->save();
        return redirect()->back()->with('alertify-success', 'وضعیت پرداخت به لغو شده تغییر کرد');

    }
    public function refund(Payment $payment)
    {
        $payment->status = 3;
        $payment->save();
        return redirect()->back()->with('alertify-success', 'وضعیت پرداخت به برگشت وجه تغییر کرد');
    }
    public function show(Payment $payment)
    {
        return view('admin.market.payment.show', compact('payment'));
    }
}
