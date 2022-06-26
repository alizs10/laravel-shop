<?php

namespace App\Http\Services;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartServices {

    public function calculate() {
        $user = Auth::user();
        if (empty($user)) {
        $ip_address = request()->ip();
            $cart_items = CartItem::where('ip_address', $ip_address)->get();
        } else {
            $cart_items = $user->cart_items;
        }

        
        $pay_price = 0;
        $discount_price = 0;
        foreach ($cart_items as $cart_item) {
            $pay_price += $cart_item->product->price * $cart_item->number;
            if (!empty($cart_item->product->amazingSale)) {
                $discount_price = +($cart_item->product->amazingSale->first()->percentage * $cart_item->product->price * $cart_item->number) / 100;
            }
        }
        
        $total_pay_price = $pay_price - $discount_price;

        return [
            'pay_price' => $pay_price,
            'discount_price' => $discount_price,
            'total_pay_price' => $total_pay_price,
        ];


    }
}