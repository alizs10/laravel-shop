<?php

namespace App\Http\Services;

class OrderServices
{
    public function calculate($order)
    {

        $order_final_amount = 0;
        foreach ($order->items as $order_item) {
            $order_final_amount += $order_item->final_total_price;
        }
    }

    public function getAttributes($order_item)
    {
        $attributes = [
            'category_values' => [],
            'color_id' => null,
            'guaranty_id' => null,
        ];

        $attributes['color_id'] = $order_item->color_id;
        $attributes['guaranty_id'] = $order_item->guaranty_id;
        $selected_attributes = $order_item->orderItemSelectedAttributes;

        if (!empty($selected_attributes->toArray())) {
            foreach ($selected_attributes as $selected_attribute) {
                array_push($attributes['category_values'], $selected_attribute->category_value_id);
            }
        }

        return $attributes;
    }

    public function getItemPrice($item)
    {

        //calculate price
        $product_price = $item->product->price;
        $discount_amount = 0;

        //check for color price increase
        if ($item->color) {
            $product_color_price = $item->color->price_increase;
            $product_price += $product_color_price;
        }

        //check for product attributes price increase
        if ($item->orderItemSelectedAttributes->count() > 0) {
            foreach ($item->orderItemSelectedAttributes as $selected_attribute) {
                $product_price += json_decode($selected_attribute->value)->price_increase;
            }
        }

        //check for product discount
        if (!empty($item->amazing_sale_id)) {
            $amazing_sale = json_decode($item->amazing_sale_object);
            $discount_amount = ($amazing_sale->percentage * $product_price) / 100;
        }

        if (!empty($item->public_discount_id)) {
            $public_discount = json_decode($item->public_discount_object);
            $discount_amount = ($public_discount->percentage * $product_price) / 100;
        }


        $ultimate_price = $product_price - $discount_amount;

        return [
            'product_price' => $product_price,
            'discount_amount' => $discount_amount,
            'ultimate_price' => $ultimate_price
        ];
    }
}
