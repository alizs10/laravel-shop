<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\LikeUser;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Product $product)
    {
        $related_products = Product::where('cat_id', $product->cat_id)->get()->except(['id' => $product->id]);
        return view('app.product', compact('product', 'related_products'));
    }

    public function likeComment(Comment $comment)
    {
        $user = Auth::user();
        if (empty($user)) {
            return redirect()->route('auth.index');
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

    public function dislikeComment()
    {
        $user = Auth::user();
        if (empty($user)) {
            return redirect()->route('auth.index');
        }
    }
}
