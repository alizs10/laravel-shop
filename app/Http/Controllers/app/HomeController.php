<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Content\AdvertisementBaner;
use App\Models\Market\AmazingSale;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\ProductVisit;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // visit
        $ip_address = request()->ip();
        $customer_exists = Visit::where('ip_address', $ip_address)->first();
        if ($customer_exists) {
            $customer_exists->increment('number');
        } else {
            Visit::create([
                'ip_address' => $ip_address,
                'number' => 1
            ]);
        }


        //slidershow
        $slideshowBaners = AdvertisementBaner::where('position', 0)->take(3)->get();
        // ad-1
        $banerOne = AdvertisementBaner::where('position', 1)->first();
        // ad-2
        $banerTwo = AdvertisementBaner::where('position', 2)->first();
        // ad-3
        $banerThree = AdvertisementBaner::where('position', 3)->first();

        $brands = Brand::all();

        //get last visited products

        $user = Auth::user();
        if (!$user) {
            $lastVisitedProducts = ProductVisit::where('ip_address', $ip_address)->get();
        } else {
            $lastVisitedProducts = $user->productVisits;
        }
        $lastVisitedProducts->filter(function ($item) {
            return $item->product->ultimate_price > 0;
        })->values();

        $amazingSaleProducts = AmazingSale::all();
        $amazingSaleProducts = $amazingSaleProducts->filter(function ($item) {
            return $item->product->ultimate_price > 0;
        })->values();
        $products = Product::all();

        $leastMarketableProducts = $products->sortBy('marketable_number', SORT_NATURAL)->filter(function ($item) {
            return $item->ultimate_price > 0;
        })->values();
        return view('app.index', compact('amazingSaleProducts', 'leastMarketableProducts', 'products', 'lastVisitedProducts','slideshowBaners', 'banerTwo', 'banerOne', 'banerThree', 'brands'));
    }

    public function search(Request $request)
    {
        $search_for = "%" . $request->get("search") . "%";
        $product_categories_results = ProductCategory::where('name', 'like', $search_for)->get();
        $products_results = Product::where('name', 'LIKE', $search_for)->get();

        return response()->json([
            "categories" => $product_categories_results,
            "products" => $products_results,
        ]);
    }

    public function brands()
    {
        $brands = Brand::all();

        return view('app.brands', compact('brands'));
    }
}
