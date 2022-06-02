<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Market\AmazingSale;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $amazingSaleProducts = AmazingSale::all();
        $products = Product::all();
        $leastMarketableProducts = $products->sortBy('marketable_number', SORT_NATURAL);
        return view('app.index', compact('amazingSaleProducts', 'leastMarketableProducts', 'products'));
    }

    
}
