<?php

namespace App\Providers;

use App\Models\Comment;
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
        $unseenComments = Comment::where('seen', 0)->orderBy('created_at', 'desc')->get();
        View::share('unseenComments', $unseenComments);
    }
}
