<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Content\AdvertisementBaner;
use App\Models\Market\AmazingSale;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //slidershow
        $slideshowBaners = AdvertisementBaner::where('position', 0)->take(3)->get();
        // ad-1
        $banerOne = AdvertisementBaner::where('position', 1)->first();
        // ad-2
        $banerTwo = AdvertisementBaner::where('position', 2)->first();
        // ad-3
        $banerThree = AdvertisementBaner::where('position', 3)->first();

        $brands = Brand::all();


        $amazingSaleProducts = AmazingSale::all();
        $products = Product::all();
        $leastMarketableProducts = $products->sortBy('marketable_number', SORT_NATURAL);
        return view('app.index', compact('amazingSaleProducts', 'leastMarketableProducts', 'products', 'slideshowBaners', 'banerTwo', 'banerOne', 'banerThree', 'brands'));
    }

    
}
