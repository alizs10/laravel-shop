<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

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

        dd($products);
    }
}
