<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Comment;
use App\Models\LikeUser;
use App\Models\Market\Product;
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


        $related_products = Product::where('cat_id', $product->cat_id)->get()->except(['id' => $product->id]);
        return view('app.product', compact('product', 'related_products', 'user_comment_likes_ids', 'product_attributes_select_type'));
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
                unset($cart_items[$key]);
                $is_item_exists = true;
            }
        }

        if (!$is_item_exists) {
            if (empty($user)) {
               $new_item = CartItem::create([
                    'product_id' => $product->id,
                    'ip_address' => $ip_address,
                ]);
            } else {
               $new_item = CartItem::create([
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                ]);
            }

            $cart_items->push($new_item);
        }

        $pay_price = 0;
        $discount_price = 0;
        foreach ($cart_items as $cart_item) {
            $pay_price += $cart_item->product->price;
            if(!empty($cart_item->product->amazingSale)) {
                $discount_price=+ ($cart_item->product->amazingSale->first()->percentage * $cart_item->product->price) /100;
            }
        }

        $total_pay_price = $pay_price - $discount_price;

        return response()->json([
            'items' => $cart_items->toArray(),
            'status' => !$is_item_exists,
            'pay_price' => price_formater($pay_price),
            'discount_price' => price_formater($discount_price),
            'total_pay_price' => price_formater($total_pay_price)
        ]);

       
    }
}
