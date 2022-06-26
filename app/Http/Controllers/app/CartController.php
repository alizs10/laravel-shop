<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart_items = [];
        $user = Auth::user();
        if (empty($uesr)) {
            $ip_address = request()->ip();
            $cart_items = CartItem::where('ip_address', $ip_address)->get();
        } else {
            $cart_items = $user->cart_items()->get();
        }

        $related_cats_ids = [];
        $related_products = collect();
        $related_products_ids = [];

        foreach ($cart_items as $cart_item) {
            $cat_id = $cart_item->product->category->id;
            if (array_search($cat_id, $related_cats_ids) === false) {
                array_push($related_cats_ids, $cat_id);
            }
        }

        foreach ($related_cats_ids as $cat_id) {
            $cat = ProductCategory::find($cat_id);
            $cat_products = $cat->products;
            foreach ($cat_products as $cat_product) {
                array_push($related_products_ids, $cat_product->id);
                $related_products->push($cat_product);
            }
        }

   
        foreach ($cart_items as $cart_item) {
          
            if (array_search($cart_item->product_id, $related_products_ids) !== false) {
                $related_products = $related_products->reject(function ($value, $key) use($cart_item) {   
                    return $value->id != $cart_item->product_id;
                });
            }
        }


        return view('app.cart', compact('related_products'));
    }
}