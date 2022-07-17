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

        return view('app.products', compact('page'));
    }

    public function recommended()
    {
        $products = Product::all();
        $products = $products->filter(function ($product) {
            return $product->getSoldNumber([], true) >= 5 && $product->isMarketable([], true);
        })->sort(function ($a, $b) {
            return $a->getSoldNumber([], true) < $b->getSoldNumber([], true);
        })->values();


        dd($products);
    }

    public function categoryProducts(ProductCategory $category)
    {
        $allProducts = collect();
        function getAllChildrenProducts ($cat, $allProducts)
        {
            $category_products = $cat->products;
            foreach ($category_products as $category_product) {
                $allProducts->push($category_product);
            }
            if ($cat->children->count() > 0) {
                foreach ($cat->children as $cat_child) {
                    getAllChildrenProducts($cat_child, $allProducts);
                }

            }
           
            return true;
        };
        getAllChildrenProducts($category, $allProducts);
      

        dd($allProducts);
    }

    public function brandProducts(Brand $brand)
    {
        $products = $brand->products;

        dd($products);
    }
}
