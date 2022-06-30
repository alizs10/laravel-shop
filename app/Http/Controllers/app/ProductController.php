<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\CartItemSelectedAttribute;
use App\Models\Comment;
use App\Models\LikeUser;
use App\Models\Market\Product;
use App\Models\Market\ProductColor;
use App\Models\Market\PropertyValue;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Product $product)
    {
        //comments
        $user_comment_likes_ids = [];
        if (!empty(Auth::user())) {

            $user_comment_likes = LikeUser::where([
                'likable_type' => 'App\Models\Comment',
                'user_id' => Auth::user()->id
            ])->get('likable_id')->toArray();

            if (count($user_comment_likes) > 0) {
                foreach ($user_comment_likes as $user_comment_like) {
                    array_push($user_comment_likes_ids, $user_comment_like['likable_id']);
                }
            }
        }


        // product properties
        $product_attributes_select_type = [];

        foreach ($product->category->attributes as $category_attribute) {
            foreach ($category_attribute->values as $category_attribute_value) {

                if ($category_attribute_value->product_id == $product->id && $category_attribute_value->type == 1) {
                    $product_attributes_select_type[$category_attribute->name] = $category_attribute->values;
                }
            }
        }

        //related products
        $related_products = Product::where('cat_id', $product->cat_id)->get()->except(['id' => $product->id]);

        //is in cart
        $is_product_in_cart = false;

        $user = Auth::user();
        if (empty($user)) {
            $ip_address = request()->ip();
            $cart_items = CartItem::where('ip_address', $ip_address)->get();
        } else {
            $cart_items = $user->cart_items;
        }

        $cartItem = $cart_items->where('product_id', $product->id)->first();
        if (!empty($cartItem)) {
            $is_product_in_cart = true;
        }

        return view('app.product', compact('product', 'related_products', 'user_comment_likes_ids', 'product_attributes_select_type', 'is_product_in_cart', 'cartItem'));
    }

    public function likeComment(Comment $comment)
    {
        $user = Auth::user();
        if (empty($user)) {
            return redirect()->route('auth.index');
        }

        $isCmLiked = LikeUser::where([
            'user_id' => $user->id,
            'likable_type' =>  'App\Models\Comment',
            'likable_id' => $comment->id
        ])->first();

        if (!empty($isCmLiked)) {
            $comment->likes()->decrement('likes');
            $isCmLiked->delete();
            return redirect()->back();
        }

        if (empty($comment->likes->first())) {

            $comment->likes()->create([
                'likable_id' => $comment->id,
                'likable_type' => 'App\Models\Comment'
            ]);
        }

        $comment->likes()->increment('likes');

        LikeUser::updateOrCreate([
            'user_id' => $user->id,
            'like_type' => 0,
            'likable_id' => $comment->id,
            'likable_type' => 'App\Models\Comment'
        ]);

        return redirect()->back();
    }

    public function sendComment(Request $request, Product $product)
    {
        $user = Auth::user();
        if (empty($user)) {
            return redirect()->route('auth.index');
        }

        $request->validate([
            'body' => 'required|min:3|max:500'
        ]);

        Comment::create([
            'author_id' => $user->id,
            'commentable_type' => 'App\Models\Market\Product',
            'commentable_id' => $product->id,
            'body' => $request->body,
        ]);

        return redirect()->route('app.product.index', $product->id);
    }

    public function addToCart(Product $product)
    {
        $user = Auth::user();
        if (empty($user)) {
            $ip_address = request()->ip();
            $cart_items = CartItem::where('ip_address', $ip_address)->get();
        } else {
            $cart_items = $user->cart_items;
        }
        $is_item_exists = false;

        foreach ($cart_items as $key => $cart_item) {
            if ($cart_item->product_id == $product->id) {
                CartItem::destroy($cart_item->id);
                CartItemSelectedAttribute::where('cart_item_id', $cart_item->id)->delete();
                unset($cart_items[$key]);
                $is_item_exists = true;
            }
        }

        //create new cart item
        if (!$is_item_exists) {
            $new_item_input['product_id'] = $product->id;

            //check for color
            $product_default_color = $product->colors->first();
            if (!empty($product_default_color)) {
                $new_item_input['color_id'] = $product_default_color->id;
            }

            if (empty($user)) {
                $new_item_input['ip_address'] = $ip_address;
                $new_item = CartItem::create($new_item_input);
            } else {
                $new_item_input['user_id'] = $user->id;
                $new_item = CartItem::create($new_item_input);
            }

            $cart_items->push($new_item);
        }

        //check for default attributes values
        if (!$is_item_exists) {
            $properties = $product->properties()->get();
            $attr_properties = [];
            if ($properties->count() > 0) {

                foreach ($properties as $property) {
                    if (!empty($attr_properties[$property->attribute->name])) {
                        array_push($attr_properties[$property->attribute->name], $property);
                    } else {

                        $attr_properties[$property->attribute->name][0] = $property;
                    }
                }
            }

            if (count($attr_properties) > 0) {
                foreach ($attr_properties as $value) {
                    $cartItemSelectedAttribute['cart_item_id'] = $new_item->id;
                    $cartItemSelectedAttribute['category_attribute_id'] = $value[0]->category_attribute_id;
                    $cartItemSelectedAttribute['category_value_id'] = $value[0]->id;
                    $cartItemSelectedAttribute['value'] = $value[0]->value;
                    CartItemSelectedAttribute::create($cartItemSelectedAttribute);
                }
            }
        }





        $pay_price = 0;
        $discount_price = 0;
        foreach ($cart_items as $cart_item) {

            $product_price = $cart_item->product->price;

            //check for price increase
            if (count($cart_item->cartItemSelectedAttributes) > 0) {
                foreach ($cart_item->cartItemSelectedAttributes as $selected_attr) {
                    $value = json_decode($selected_attr->value);
                    $product_price += $value->price_increase;
                }
            }

            if (!empty($cart_item->color_id)) {
                $color_price = $cart_item->color->price_increase;
                $product_price += $color_price;
            }


            $pay_price += $product_price;
            if (!empty($cart_item->product->amazingSale)) {
                $discount_price = + ($cart_item->product->amazingSale->first()->percentage * $product_price) / 100;
            }
        }

        $total_pay_price = $pay_price - $discount_price;

        return response()->json([
            'items' => $cart_items->toArray(),
            'cart_count' => e2p_numbers($cart_items->count()),
            'status' => !$is_item_exists,
            'pay_price' => price_formater($pay_price),
            'discount_price' => price_formater($discount_price),
            'total_pay_price' => price_formater($total_pay_price)
        ]);
    }

    public function toggleFavorite(Product $product)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'redirect' => true,
                'url' => route('app.home')
            ]);
        }
        $is_in_favorites = $user->favorites()->where('product_id', $product->id)->first();

        if (!empty($is_in_favorites)) {
            $user->favorites()->detach($product);
            return response()->json([
                'status' => false,
            ]);
        }

        $user->favorites()->attach($product);

        return response()->json([
            'status' => true,
        ]);
    }

    public function getPrice(Request $request, Product $product)
    {
        $request->validate([
            'attributes[]' => 'nullable|array',
            'attributes.*' => 'numeric|exists:category_values,id',
            'color_id' => 'nullable|numeric|exists:product_colors,id',
        ]);

        $color = false;

        if (!empty($request->get('color_id'))) {
            $color_id = $request->get('color_id');
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
        if ($request->has('attributes')) {
            $category_value_ids = $request->get('attributes');
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

        return response()->json([
            'product_price' => price_formater($product_price),
            'ultimate_price' => price_formater($ultimate_price)
        ]);
    }
}
