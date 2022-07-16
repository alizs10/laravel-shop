<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request, $search = null)
    {
        //default filters
        $price = false;
        $cat_id = false;
        $brand_id = false;
        $exists = false;

        if ($request->has("price")) {
            preg_match("/(\d{1,20})-(\d{1,20})/", $request->get("price"), $matches);

            if (!empty($matches)) {
                $price_start = explode("-", $matches[0])[0];
                $price_end = explode("-", $matches[0])[1];
                $price = [$price_start, $price_end];
            }
        }

        if ($request->has("cat")) {
            $cat_id = $request->get("cat");
        }

        if ($request->has("brand")) {
            $brand_id = $request->get("brand");
        }

        if ($request->has("exists")) {
            $exists = $request->get("exists") === "true" ? true : false;
        }

        $filters = [
            "price" => $price,
            "cat" => $cat_id,
            "brand" => $brand_id,
            "exists" => $exists
        ];

        if (!$price && !$cat_id && !$exists) {
            $filters = false;
        }


        $query = Product::where('name', 'LIKE', '%' . $search . '%');

        !$price ?: $query->whereBetween('price', [$price]);
        !$cat_id ?: $query->where('cat_id', $cat_id);
        !$brand_id ?: $query->where('brand_id', $brand_id);

        $categories = ProductCategory::whereNull("parent_id")->get();
        $selected_category = false;

        if ($cat_id) {
            $selected_category = ProductCategory::find($cat_id);
        }



        $results = $query->get();
        if ($exists) {
            $results = $results->filter(function ($item) {
                return $item->ultimate_price > 0;
            })->values();
        }
        return view('app.search', compact('results', 'search', 'filters', 'categories', 'selected_category'));
    }
}
