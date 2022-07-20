<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Market\Product;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data = [];

        $data['usersCount'] = User::all()->count();
        $data['productsCount'] = Product::all()->count();
        $data['commentsCount'] = Comment::all()->count();

        $visits = Visit::all();
        $visits_counter = 0;
        foreach ($visits as $visit) {
            $visits_counter += $visit->number;
        }

        $data['visitsCount'] = $visits_counter;
        $data['date'] = now();
        return view('admin.index', compact('data'));
    }
}
