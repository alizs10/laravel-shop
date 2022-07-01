<?php

namespace App\Http\Services;

use App\Models\Market\ProductColor;
use App\Models\Market\PropertyValue;

class ProductServices
{
    public function getPrice($product, $attributes = [])
    {
        $color = false;

        if (!empty($attributes['color_id'])) {
            $color_id = $attributes['color_id'];
            $color = ProductColor::find($color_id);
            if ($product->id != $color->product_id) {
                return false;
            }
        }



        $product_price = $product->price;
        $discount_amount = 0;

        //check for color price increase
        if ($color) {
            $product_color_price = $color->price_increase;
            $product_price += $product_color_price;
        }

        //check for product attributes price increase
        if ($attributes['category_values']) {
            $category_value_ids = $attributes['category_values'];
            $category_values = PropertyValue::whereIn('id', $category_value_ids)->get();
            if ($category_values->count() > 0) {
                foreach ($category_values as $category_value) {
                    $product_price += json_decode($category_value->value)->price_increase;
                }
            }
        }

        //check for product discount
        if (!empty($product->amazingSale)) {
            $discount_amount = ($product->amazingSale->percentage * $product_price) / 100;
        }


        $ultimate_price = $product_price - $discount_amount;

        return [
            'product_price' => $product_price,
            'ultimate_price' => $ultimate_price
        ];

    }
}