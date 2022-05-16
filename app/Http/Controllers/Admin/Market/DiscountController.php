<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\PublicDiscoutRequest;
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

    //
    public function amazingDiscount()
    {
        return view('admin.market.discount.amazingDiscount');
    }

    public function amazingDiscountCreate()
    {
        return view('admin.market.discount.amazingDiscountCreate');
    }
}
