<?php

namespace App\Providers;

use App\Http\Services\CartServices;
use App\Models\CartItem;
use App\Models\Comment;
use App\Models\Content\Menu;
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
            //menus
            $menus = Menu::whereNull('parent_id')->get();
            //cart
            $cartServices = new CartServices();
            $cart_items = $cartServices->getCartItems();

            $view
                ->with('cart_items', $cart_items)
                ->with('menus', $menus);
        });
    }
}
