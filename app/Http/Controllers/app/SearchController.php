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
        $brand_ids = false;
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

        if ($request->has("brands")) {
            $brand_ids = explode(',',$request->get("brands"));
        }

        if ($request->has("exists")) {
            $exists = $request->get("exists") === "true" ? true : false;
        }

        $filters = [
            "price" => $price,
            "cat" => $cat_id,
            "brands" => $brand_ids,
            "exists" => $exists
        ];

        if (!$price && !$cat_id && !$exists && !$brand_ids) {
            $filters = false;
        }


        $query = Product::where('name', 'LIKE', '%' . $search . '%');

        !$price ?: $query->whereBetween('price', [$price]);
        !$cat_id ?: $query->where('cat_id', $cat_id);
        !$brand_ids ?: $query->where('brand_id', $brand_ids);

        $categories = ProductCategory::whereNull("parent_id")->get();
        $brands = Brand::all();
        $selected_category = false;
        $selected_brands = false;

        if ($cat_id) {
            $selected_category = ProductCategory::find($cat_id);
        }

        if ($brand_ids) {
            $selected_brands = Brand::find($brand_ids);
        }

        $results = $query->get();
        if ($exists) {
            $results = $results->filter(function ($item) {
                return $item->ultimate_price > 0;
            })->values();
        }
        return view('app.search', compact('results', 'search', 'filters', 'categories', 'selected_category', 'brands', 'selected_brands'));
    }
}
