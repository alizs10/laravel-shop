<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function all()
    {
        return view('admin.market.order.all');
    }

    public function newOrders()
    {
        return view('admin.market.order.new-orders');
    }

    public function delivering()
    {
        return view('admin.market.order.delivering');
    }

    public function unpaid()
    {
        return view('admin.market.order.unpaid');
    }

    public function expired()
    {
        return view('admin.market.order.expired');
    }

    public function returned()
    {
        return view('admin.market.order.returned');
    }
}
