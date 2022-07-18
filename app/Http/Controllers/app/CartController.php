<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Http\Services\CartServices;
use App\Http\Services\ProductServices;
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
        $cart_calculations["cart_item"] = $cart_services->calcualteCartItem($cart_item);
        return response()->json([
            'number' => $cart_item->number,
            'pay_price' => $cart_calculations['pay_price'],
            'discount_price' => $cart_calculations['discount_price'],
            'total_pay_price' => $cart_calculations['total_pay_price'],
            'ultimate_price' => $cart_calculations["cart_item"]['ultimate_price'],
            'discount_amount' => $cart_calculations["cart_item"]['discount_amount'],
            'cart_item_id' => $cart_item->id,
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
        $cart_calculations["cart_item"] = $cart_services->calcualteCartItem($cart_item);

        return response()->json([
            'number' => $cart_item->number,
            'pay_price' => $cart_calculations['pay_price'],
            'discount_price' => $cart_calculations['discount_price'],
            'total_pay_price' => $cart_calculations['total_pay_price'],
            'ultimate_price' => $cart_calculations["cart_item"]['ultimate_price'],
            'discount_amount' => $cart_calculations["cart_item"]['discount_amount'],
            'cart_item_id' => $cart_item->id,
        ]);
    }

    public function destroy(CartItem $cart_item, ProductServices $productServices)
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

        $attributes = $cart_item->itemAttributes();
        $productServices->unfroze($attributes);
        $cart_item->cartItemSelectedAttributes()->delete();
        $cart_item->delete();

        return redirect()->back();
    }

    public function storeOrder()
    {
        $user = Auth::user();
        if (empty($user)) {
            session(['back_url' => route('app.cart.index')]);
            session(['move_cart_items' => true]);
            return redirect()->route('auth.index');
            exit;
        }

        $cart_items = $user->cart_items;
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
            $order_item_input['product_id'] = $cart_item->product_id;
            $order_item_input['product_object'] = $cart_item->product;
            if (!empty($cart_item->product->amazingSale)) {
                $order_item_input['amazing_sale_id'] = $cart_item->product->amazingSale->id;
                $order_item_input['amazing_sale_object'] = $cart_item->product->amazingSale;
            }
            if (!empty($cart_item->product->has_public_discount) && empty($cart_item->product->amazingSale)) {
                $order_item_input['public_discount_id'] = $cart_item->product->has_public_discount->id;
                $order_item_input['public_discount_object'] = $cart_item->product->has_public_discount;
            }
            $order_item_input['number'] = $cart_item->number;
            $item_attributes = $cart_item->itemAttributes();
            $item_prices = $cart_item->product->getPrice($item_attributes);
            $order_item_input['product_unit_price'] = $item_prices['product_price'];
            $order_item_input['final_product_price'] = $item_prices['ultimate_price']; //procut price after discount
            $order_item_input['final_total_price'] = $item_prices['ultimate_price'] * $cart_item->number;
            $order_item_input['color_id'] = $cart_item->color_id;
            $order_item_input['guaranty_id'] = $cart_item->guaranty_id;


            $order_item = $order->items()->create($order_item_input);


            //move cart items selected attributes to order item selected attributes
            foreach ($cart_item->cartItemSelectedAttributes as $cart_item_selected_attribute) {
                $selected_attribute_input['order_item_id'] = $order_item->id;
                $selected_attribute_input['category_attribute_id'] = $cart_item_selected_attribute->category_attribute_id;
                $selected_attribute_input['category_value_id'] = $cart_item_selected_attribute->category_value_id;
                $selected_attribute_input['value'] = $cart_item_selected_attribute->value;
                $order_item->orderItemSelectedAttributes()->create($selected_attribute_input);
                
            }
            $cart_item->cartItemSelectedAttributes()->delete();
        }
        $user->cart_items()->delete();

        $order_final_amount = 0;
        foreach ($order->items as $order_item) {
            $order_final_amount += $order_item->final_total_price;
        }

        $order->update(['order_final_amount' => $order_final_amount]);

        

        return redirect()->route('app.shipping.index', $order->id);
    }
}
