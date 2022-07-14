<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $this->authorize('index', Order::class);
        $page = "همه سفارشات";
        $orders = Order::all();
        return view('admin.market.order.index', compact('orders', 'page'));
    }

    public function newOrders()
    {
        $this->authorize('index', Order::class);
        $page = "سفارشات جدید";
        $orders = Order::where('order_status', 0)->get();
        foreach ($orders as $order) {
            $order->update(['order_status' => 1]);
        }
        return view('admin.market.order.index', compact('orders', 'page'));
    }

    public function processing()
    {
        $this->authorize('index', Order::class);
        $page = "سفارشات در حال پردازش";
        $orders = Order::where('order_status', 1)->get();
        return view('admin.market.order.index', compact('orders', 'page'));
    }

    public function delivering()
    {
        $this->authorize('index', Order::class);
        $page = "سفارشات در حال ارسال";
        $orders = Order::where('order_status', 2)->get();
        return view('admin.market.order.index', compact('orders', 'page'));
    }

    public function unpaid()
    {
        $this->authorize('index', Order::class);
        $page = "سفارشات پرداخت نشده";
        $orders = Order::where('payment_status', 0)->get();
        return view('admin.market.order.index', compact('orders', 'page'));
    }

    public function expired()
    {
        $this->authorize('index', Order::class);
        $page = "سفارشات لغو شده";
        $orders = Order::where('order_status', 4)->get();
        return view('admin.market.order.index', compact('orders', 'page'));
    }

    public function returned()
    {
        $this->authorize('index', Order::class);
        $page = "سفارشات مرجوعی";
        $orders = Order::where('order_status', 5)->get();
        return view('admin.market.order.index', compact('orders', 'page'));
    }

    public function changeStatus(Order $order)
    {
        $this->authorize('update', Order::class);
        $order->order_status = ($order->order_status + 1) > 5 ? 0 : $order->order_status + 1;
        $order->save();

        return redirect()->back()->with('alertify-success', 'وضعیت سفارش با موفقیت تغییر کرد');
    }
    public function changeDeliveryStatus(Order $order)
    {
        $this->authorize('update', Order::class);
        $order->delivery_status = ($order->delivery_status + 1) > 2 ? 0 : $order->delivery_status + 1;
        $order->save();

        return redirect()->back()->with('alertify-success', 'وضعیت ارسال با موفقیت تغییر کرد');
    }

    public function destroy(Order $order)
    {
        $this->authorize('delete', Order::class);
        $order->delete();

        return redirect()->back()->with('alertify-success', 'سفارش موردنظر با موفقیت حذف شد');
    }

    public function show(Order $order)
    {
        $this->authorize('index', Order::class);
        return view('admin.market.order.show', compact('order'));
    }
}
