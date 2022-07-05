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

}