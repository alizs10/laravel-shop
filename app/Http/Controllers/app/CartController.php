<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Http\Services\CartServices;
use App\Models\CartItem;
use App\Models\Market\Delivery;
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
                $related_products = $related_products->reject(function ($value, $key) use ($cart_item) {
                    return $value->id == $cart_item->product_id;
                });
            }
        }


        return view('app.cart', compact('related_products'));
    }


    public function increaseQuantity(CartItem $cart_item, CartServices $cart_services)
    {
        $user = Auth::user();

        if (empty($user)) {
            if ($cart_item->ip_address != request()->ip()) {
                return false;
            }
        } else {
            if ($cart_item->user_id != $user->id) {
                return false;
            }
        }

        $cart_item->increment('number');

        $cart_calculations = $cart_services->calculate();
        return response()->json([
            'number' => $cart_item->number,
            'pay_price' => $cart_calculations['pay_price'],
            'discount_price' => $cart_calculations['discount_price'],
            'total_pay_price' => $cart_calculations['total_pay_price'],
        ]);
    }

    public function decreaseQuantity(CartItem $cart_item, CartServices $cart_services)
    {
        $user = Auth::user();

        if (empty($user)) {
            if ($cart_item->ip_address != request()->ip()) {
                return false;
            }
        } else {
            if ($cart_item->user_id != $user->id) {
                return false;
            }
        }

        if ($cart_item->number > 1) {
            $cart_item->decrement('number');
        }

        $cart_calculations = $cart_services->calculate();
        return response()->json([
            'number' => $cart_item->number,
            'pay_price' => $cart_calculations['pay_price'],
            'discount_price' => $cart_calculations['discount_price'],
            'total_pay_price' => $cart_calculations['total_pay_price'],
        ]);
    }

    public function destroy(CartItem $cart_item)
    {
        $user = Auth::user();

        if (empty($user)) {
            if ($cart_item->ip_address != request()->ip()) {
                return false;
            }
        } else {
            if ($cart_item->user_id != $user->id) {
                return false;
            }
        }

        $cart_item->delete();

        return redirect()->route('app.cart.index');
    }

    public function storeOrder()
    {
        $user = Auth::user();
        if (empty($user)) {
            session(['back_url' => route('app.cart.index')]);
            return redirect()->route('auth.index');
        }

        $cart_items = $user->cart_items->all();
        $default_address = $user->addresses()->where('status', 1)->first();
        $default_delivery = Delivery::where('status', 1)->first();

        $order_input['address_id'] = $default_address->id;
        $order_input['address_object'] = $default_address;
        $order_input['delivery_id'] = $default_delivery->id;
        $order_input['delivery_object'] = $default_delivery;
        $order_input['delivery_amount'] = $default_delivery->amount;
        $order_input['delivery_status'] = 0;

        $order = $user->orders()->create($order_input);

        foreach ($cart_items as $cart_item) {
            $product_discount = 0;
            $order_item_input['product_id'] = $cart_item->product_id;
            $order_item_input['product_object'] = $cart_item->product;
            if (!empty($cart_item->product->amazingSale)) {
                $order_item_input['amazing_sale_id'] = $cart_item->product->amazingSale->id;
                $order_item_input['amazing_sale_object'] = $cart_item->product->amazingSale;
                $product_discount = ($cart_item->product->price * $cart_item->product->amazingSale->percentage);
            }
            $order_item_input['number'] = $cart_item->number;
            $final_product_price = $cart_item->product->price - $product_discount;
            $order_item_input['final_product_price'] = $final_product_price;
            $order_item_input['final_total_price'] = $final_product_price * $cart_item->number;
            $order_item_input['color_id'] = $cart_item->color_id;
            $order_item_input['guaranty_id'] = $cart_item->guaranty_id;


            $order->items()->create($order_item_input);
        }

        $order_final_amount = 0;
        foreach ($order->items as $order_item) {
            $order_final_amount += $order_item->final_total_price;
        }

        $order->update(['order_final_amount' => $order_final_amount]);

        return redirect()->route('app.shipping.index', $order->id);
    }
}
