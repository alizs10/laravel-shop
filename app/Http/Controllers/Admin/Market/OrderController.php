<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $page = "همه سفارشات";
        $orders = Order::all();
        return view('admin.market.order.index', compact('orders', 'page'));
    }

    public function newOrders()
    {
        $page = "سفارشات جدید";
        $orders = Order::where('order_status', 0)->get();
        foreach ($orders as $order) {
            $order->update(['order_status' => 1]);
        }
        return view('admin.market.order.index', compact('orders', 'page'));
    }

    public function processing()
    {
        $page = "سفارشات در حال پردازش";
        $orders = Order::where('order_status', 1)->get();
        return view('admin.market.order.index', compact('orders', 'page'));
    }

    public function delivering()
    {
        $page = "سفارشات در حال ارسال";
        $orders = Order::where('order_status', 2)->get();
        return view('admin.market.order.index', compact('orders', 'page'));
    }

    public function unpaid()
    {
        $page = "سفارشات پرداخت نشده";
        $orders = Order::where('payment_status', 0)->get();
        return view('admin.market.order.index', compact('orders', 'page'));
    }

    public function expired()
    {
        $page = "سفارشات لغو شده";
        $orders = Order::where('order_status', 4)->get();
        return view('admin.market.order.index', compact('orders', 'page'));
    }

    public function returned()
    {
        $page = "سفارشات مرجوعی";
        $orders = Order::where('order_status', 5)->get();
        return view('admin.market.order.index', compact('orders', 'page'));
    }

    public function changeStatus(Order $order)
    {
        $order->order_status = ($order->order_status + 1) > 5 ? 0 : $order->order_status + 1;
        $order->save();

        return redirect()->back()->with('alertify-success', 'وضعیت سفارش با موفقیت تغییر کرد');
    }
    public function changeDeliveryStatus(Order $order)
    {
        $order->delivery_status = ($order->delivery_status + 1) > 2 ? 0 : $order->delivery_status + 1;
        $order->save();

        return redirect()->back()->with('alertify-success', 'وضعیت ارسال با موفقیت تغییر کرد');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->back()->with('alertify-success', 'سفارش موردنظر با موفقیت حذف شد');
    }

    public function show(Order $order)
    {
        return view('admin.market.order.show', compact('order'));
    }
}
