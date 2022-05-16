<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\AmazingSaleReqeust;
use App\Http\Requests\Admin\Market\PublicDiscoutRequest;
use App\Models\Market\AmazingSale;
use App\Models\Market\Product;
use App\Models\Market\PublicDiscount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    //
    public function coupon()
    {
        return view('admin.market.discount.coupon');
    }

    public function couponCreate()
    {
        return view('admin.market.discount.couponCreate');
    }


    //public discounts
    public function publicDiscount()
    {
        $discounts = PublicDiscount::all();
        return view('admin.market.discount.publicDiscount', compact('discounts'));
    }

    public function publicDiscountCreate()
    {
        return view('admin.market.discount.publicDiscountCreate');
    }
    public function publicDiscountStore(PublicDiscoutRequest $request)
    {
        $inputs = $request->all();
        $inputs['valid_from'] = date('Y-m-d', intval(substr($request->valid_from, 0, 10)));
        $inputs['valid_until'] = date('Y-m-d', intval(substr($request->valid_until, 0, 10)));
        $discount = PublicDiscount::create($inputs);

        return redirect()->route('admin.market.discount.public')->with("alertify-success", "تخفیف جدید با موفقیت اضافه شد");
    }
    public function publicDiscountEdit(PublicDiscount $discount)
    {
        return view('admin.market.discount.publicDiscountEdit', compact('discount'));
    }
    public function publicDiscountUpdate(PublicDiscoutRequest $request, PublicDiscount $discount)
    {
        $inputs = $request->all();
        $inputs['valid_from'] = date('Y-m-d', intval(substr($request->valid_from, 0, 10)));
        $inputs['valid_until'] = date('Y-m-d', intval(substr($request->valid_until, 0, 10)));
        $discount->update($inputs);

        return redirect()->route('admin.market.discount.public')->with("alertify-success", "تخفیف موردنظر با موفقیت ویرایش شد");
    }
    public function publicDiscountDestroy(PublicDiscount $discount)
    {
        $discount->delete();
        return redirect()->route('admin.market.discount.public')->with("alertify-success", "تخفیف موردنظر با موفقیت حذف شد");
    }

    //amazing sales

    public function amazingDiscount()
    {
        $discounts = AmazingSale::all();
        return view('admin.market.discount.amazingDiscount', compact('discounts'));
    }

    public function amazingDiscountCreate()
    {
        $products = Product::all();
        return view('admin.market.discount.amazingDiscountCreate', compact('products'));
    }

    public function amazingDiscountStore(AmazingSaleReqeust $request)
    {
        $inputs = $request->all();
        $inputs['valid_from'] = date('Y-m-d', intval(substr($request->valid_from, 0, 10)));
        $inputs['valid_until'] = date('Y-m-d', intval(substr($request->valid_until, 0, 10)));
        $discount = AmazingSale::create($inputs);

        return redirect()->route('admin.market.discount.amazing')->with("alertify-success", "تخفیف شگفت انگیز جدید با موفقیت اضافه شد");
    }
    public function amazingDiscountEdit(AmazingSale $discount)
    {
        $products = Product::all();
        return view('admin.market.discount.amazingDiscountEdit', compact('discount', 'products'));
    }
    public function amazingDiscountUpdate(AmazingSaleReqeust $request, AmazingSale $discount)
    {
        $inputs = $request->all();
        $inputs['valid_from'] = date('Y-m-d', intval(substr($request->valid_from, 0, 10)));
        $inputs['valid_until'] = date('Y-m-d', intval(substr($request->valid_until, 0, 10)));
        $discount->update($inputs);

        return redirect()->route('admin.market.discount.amazing')->with("alertify-success", "تخفیف شگفت انگیز موردنظر با موفقیت ویرایش شد");
    }
    public function amazingDiscountDestroy(AmazingSale $discount)
    {
        $discount->delete();
        return redirect()->route('admin.market.discount.amazing')->with("alertify-success", "تخفیف شگفت انگیز موردنظر با موفقیت حذف شد");
    }
}
