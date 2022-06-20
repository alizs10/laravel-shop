<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index($search)
    {
        $results = Product::where('name', 'LIKE', '%'. $search .'%')->get();
        return view('app.search', compact('results', 'search'));
    }
}
