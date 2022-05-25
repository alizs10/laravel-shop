<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Market\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data = [];

        $data['usersCount'] = User::all()->count();
        $data['productsCount'] = Product::all()->count();
        $data['commentsCount'] = Comment::all()->count();
        $data['date'] = now();
        return view('admin.index', compact('data'));
    }
}
