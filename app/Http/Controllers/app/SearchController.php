<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request, $search)
    {
        //default filters
        $price = false;
        $cat_id = false;
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

        if ($request->has("exists")) {
            $exists = $request->get("exists") === "true" ? true : false;
        }

        $filters = [
            "price" => $price,
            "cat" => $cat_id,
            "exists" => $exists
        ];

        if (!$price && !$cat_id && !$exists) {
            $filters = null;
        }

        $query = Product::where('name', 'LIKE', '%' . $search . '%');
        !$price ?: $query->whereBetween('price', [$price]);
        !$cat_id ?: $query->where('cat_id', $cat_id);
        // !$exists ?: $query->where('price', [$price]);

        $categories = ProductCategory::whereNull("parent_id")->get();

        $results = $query->get();
        return view('app.search', compact('results', 'search', 'filters', 'categories'));
    }
}
