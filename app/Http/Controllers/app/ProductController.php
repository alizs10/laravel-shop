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
        $related_products = Product::where('cat_id', $product->cat_id)->get()->except(['id' => $product->id]);
        return view('app.product', compact('product', 'related_products', 'user_comment_likes_ids'));
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
}
