<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index(Request $request, Product $product)
    {
        return view('app.comparison', compact('product'));
    }
}
