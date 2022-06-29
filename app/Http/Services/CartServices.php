<?php

namespace App\Http\Services;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartServices
{

    public function calculate()
    {
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
            $product_price = $cart_item->product->price;

            //check for product color price increase
            if (!empty($cart_item->color)) {
                $product_price += $cart_item->color->price_increase;
            }

            //check for product attributes price increase
            if (!empty($cart_item->cartItemSelectedAttributes)) {
                foreach ($cart_item->cartItemSelectedAttributes as $selected_attribute) {
                    $product_price += json_decode($selected_attribute->value)->price_increase;
                }
            }

            $pay_price += $product_price * $cart_item->number;

            if (!empty($cart_item->product->amazingSale)) {
                $discount_price = + ($cart_item->product->amazingSale->first()->percentage * $product_price * $cart_item->number) / 100;
            }
        }

        $total_pay_price = $pay_price - $discount_price;

        return [
            'pay_price' => $pay_price,
            'discount_price' => $discount_price,
            'total_pay_price' => $total_pay_price,
        ];
    }

    public function calcualteCartItem($cart_item)
    {
        $product_price = $cart_item->product->price;
                                        
        //check for product color price increase
        if (!empty($cart_item->color)) {
            $product_price += $cart_item->color->price_increase;
        }
        
        //check for product attributes price increase
        if (!empty($cart_item->cartItemSelectedAttributes)) {
            foreach ($cart_item->cartItemSelectedAttributes as $selected_attribute) {
                $product_price += json_decode($selected_attribute->value)->price_increase;
            }
        }
        
        $final_product_price = $product_price * $cart_item->number;
        
        if (!empty($cart_item->product->amazingSale)) {
            $discount_amount = ($cart_item->product->amazingSale->percentage * $final_product_price) / 100;
        } else {
            $discount_amount = 0;
        }
        
        $ultimate_price = $final_product_price - $discount_amount;

        return [
            "ultimate_price" => $ultimate_price,
            "discount_amount" => $discount_amount,
        ];
    }

    public function moveCartItems()
    {
        $user = Auth::user();

        if (empty($user)) {
            return false;
        }

        $ip_address = request()->ip();
        $cart_items = CartItem::where('ip_address', $ip_address)->get();

        if (!empty($cart_items)) {
            foreach ($cart_items as $cart_item) {
                $cart_item->update([
                    'user_id' => $user->id,
                    'ip_address' => null,
                ]);
            }
        }

        return true;
    }
}
