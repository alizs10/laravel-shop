<?php

namespace App\Http\Services;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartServices
{

    public function calculate()
    {
        $cart_items = $this->getCartItems();

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

    public function isInCart($product, $attributes = [], $has_defaults_attributes = false)
    {

        // attributes => category_values, color_id, guaranty_id
        $cart_items = $this->getCartItems();

        if (empty($cart_items->toArray())) {
            return false;
        }

        $same_products = $cart_items->where('product_id', $product->id)->all();

        if (empty($same_products)) {
            return false;
        }

       

        //set defaults attributes
        if ($has_defaults_attributes) {
          
            $productServices = new ProductServices();
            $attributes = $productServices->getDefaultAttributes($product);
        }

        //check for attributes
        return $this->checkCategoryValues($same_products, $attributes);


        return false;
    }

    public function getCartItems()
    {
        $user = Auth::user();
        if (empty($user)) {
            $ip_address = request()->ip();
            $cart_items = CartItem::where('ip_address', $ip_address)->get();
        } else {
            $cart_items = $user->cart_items->get();
        }


        return $cart_items;
    }

    private function checkCategoryValues($same_products, $attributes)
    {
        foreach ($same_products as $same_product) {

            $is_color_id_match = false;
            $is_guaranty_id_match = false;
            $is_category_values_match = false;

            //first => color_id
            if ($same_product->color_id == $attributes['color_id']) {
                $is_color_id_match = true;
            }
            //second => guaranty_id
            if ($same_product->color_id == $attributes['color_id']) {
                $is_guaranty_id_match = true;
            }

            //third => category values
            if (empty($attributes['category_values']) && empty($same_product->cartItemSelectedAttributes->toArray())) {
          

                $is_category_values_match = true;
            } else {
                $cart_item_category_values = $same_product->cartItemSelectedAttributes()->get('category_value_id')->toArray();
                $cart_item_category_value_ids = [];
                if (!empty($cart_item_category_values)) {
                    foreach ($cart_item_category_values as $cart_item_category_value) {
                        array_push($cart_item_category_value_ids, $cart_item_category_value['category_value_id']);
                    }
                    if (!$is_category_values_match && count($cart_item_category_value_ids) == count($attributes['category_values'])) {
                        if ($attributes['category_values'] == $cart_item_category_value_ids) {
                            $is_category_values_match = true;
                        }
                    }
                }
            }
           
        
            if ($is_category_values_match && $is_guaranty_id_match && $is_color_id_match) {
                return $same_product;
                exit;
            }
        }

        return false;
    }
}
