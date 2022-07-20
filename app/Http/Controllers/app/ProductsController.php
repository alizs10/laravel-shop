<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\ProductVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function amazingSales()
    {
        $products = Product::all();
        $products = $products->filter(function ($product) {
            return !empty($product->amazingSale);
        });

        $page = "کالاهای شگفت انگیز";

        return view('app.products', compact('page', 'products'));
    }

    public function recommended()
    {
        $products = Product::all();
        $products = $products->filter(function ($product) {
            return $product->getSoldNumber([], true) >= 1 && $product->isMarketable([], true);
        })->sort(function ($a, $b) {
            return $a->getSoldNumber([], true) < $b->getSoldNumber([], true);
        })->values();

        $page = "کالاهای پیشنهادی لاراول به شما";

        return view('app.products', compact('page', 'products'));
    }

    public function categoryProducts(ProductCategory $category)
    {
        $products = collect();
        function getAllChildrenProducts ($cat, $products)
        {
            $category_products = $cat->products;
            foreach ($category_products as $category_product) {
                $products->push($category_product);
            }
            if ($cat->children->count() > 0) {
                foreach ($cat->children as $cat_child) {
                    getAllChildrenProducts($cat_child, $products);
                }

            }
           
            return true;
        };
        getAllChildrenProducts($category, $products);
        $page = "دسته بندی $category->name";

        return view('app.products', compact('page', 'products'));
    }

    public function brandProducts(Brand $brand)
    {
        $products = $brand->products;

        $page = "برند $brand->persian_name";

        return view('app.products', compact('page', 'products'));
    }


    public function lastVisitedProducts()
    {
        $user = Auth::user();
        if (!$user) {
            $ip_address = request()->ip();
            $lastVisitedProducts = ProductVisit::where('ip_address', $ip_address)->get();
        } else {
            $lastVisitedProducts = $user->productVisits;
        }
        $lastVisitedProducts->filter(function ($item) {
            return $item->product->ultimate_price > 0;
        })->values();

        $products = collect();
        foreach ($lastVisitedProducts as $lastVisitedProduct) {
            $products->push($lastVisitedProduct->product);
        }
        $page = "بازدیدهای اخیر شما";
 
        return view('app.products', compact('page', 'products'));
    }
}
