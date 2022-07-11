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


}