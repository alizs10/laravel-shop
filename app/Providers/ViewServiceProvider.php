<?php

namespace App\Providers;

use App\Models\CartItem;
use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // admin dashboard
        View::composer('admin.*', function ($view) {
            $unseenComments = Comment::where('seen', 0)->orderBy('created_at', 'desc')->get();
            $unreadNotifications = Notification::where('read_at', null)->get();
            $view
            ->with('unseenComments', $unseenComments)
            ->with('unreadNotifications', $unreadNotifications);
        });


        // application
        View::composer('app.*', function ($view) {
            $user = Auth::user();
            if (empty($user)) {
            $ip_address = request()->ip();
                $cart_items = CartItem::where('ip_address', $ip_address)->get();
            } else {
                $cart_items = $user->cart_items;
            }

            $view
            ->with('cart_items', $cart_items);
        });
    }
}
