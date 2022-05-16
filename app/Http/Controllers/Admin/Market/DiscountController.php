<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function coupon()
    {
        return view('admin.market.discount.coupon');
    }

    public function couponCreate()
    {
        return view('admin.market.discount.couponCreate');
    }

    public function publicDiscount()
    {
        return view('admin.market.discount.publicDiscount');
    }

    public function publicDiscountCreate()
    {
        return view('admin.market.discount.publicDiscountCreate');
    }

    public function amazingDiscount()
    {
        return view('admin.market.discount.amazingDiscount');
    }

    public function amazingDiscountCreate()
    {
        return view('admin.market.discount.amazingDiscountCreate');
    }
}
