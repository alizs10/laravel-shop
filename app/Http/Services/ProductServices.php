<?php

namespace App\Http\Services;

use App\Models\Market\ProductColor;
use App\Models\Market\PropertyValue;

class ProductServices
{
    public function getPrice($product, $attributes = [], $has_defaults_attributes = false)
    {
        $color = false;

        if ($has_defaults_attributes) {
            //rewrite $attributes
            $attributes = $this->getDefaultAttributes($product);
        }

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

    public function getDefaultAttributes($product)
    {
        $default_guaranty_id = null;
        $default_color_id = null;
        $default_category_values = [];

        if (!empty($product->colors->toArray())) {
            $default_color_id = $product->colors->first()->id;
        }

        $properties = $product->properties()->get();

        if ($properties->count() > 0) {
            $category_attribute_ids = [];
            foreach ($properties as $property) {
                if (!in_array($property->category_attribute_id, $category_attribute_ids)) {
                    array_push($category_attribute_ids, $property->category_attribute_id);
                    $default_value = $properties->where('category_attribute_id', $property->category_attribute_id)->first();
                    array_push($default_category_values, $default_value->id);
                }
            }
        }

        $default_attributes = [
            'category_values' => $default_category_values,
            'color_id' => $default_color_id,
            'guaranty_id' => $default_guaranty_id
        ];

        return $default_attributes;
    }

    public function isMarketable($product, $attributes = [], $has_defaults_attributes = false)
    {
        if ($has_defaults_attributes) {
            $attributes = $this->getDefaultAttributes($product);
        }

        

        //check for product color
        if (!empty($product->colors->toArray())) {
            $product_colors = $product->colors;
            $color = $product_colors->where(['color_id' => $attributes['color_id']])->first();
            if ($color) {
                return $color->marketable_number > 0 ? true : false;
            } 

            return false;
        }
        //check for attributes
        if (!empty($attributes['category_values'])) {
            foreach ($attributes['category_values'] as $property_value_id) {
                $product_property = PropertyValue::find($property_value_id);
                if ($product_property && $product_property->product_id == $product->id) {
                    return $product_property->marketable_number > 0 ? true : false;
                }

                return false;
            }
        }

        return false;

    }
}