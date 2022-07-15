<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index(Request $request, Product $first_product = null, Product $second_product = null)
    {
        if ($second_product != null) {
            if ($first_product->cat_id != $second_product->cat_id) {
                $second_product = null;
            }
        }

        $comparable_products = [];
        if ($second_product == null && !empty($first_product)) {
            $comparable_products = Product::where('cat_id', $first_product->cat_id)->get()->except($first_product->id);
        }

        if ($first_product == null && $second_product == null) {
            $comparable_products = Product::all();
        }

        return view('app.comparison', compact('first_product', 'second_product', 'comparable_products'));
    }
}
