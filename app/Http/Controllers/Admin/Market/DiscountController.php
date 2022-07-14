<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\AmazingSaleReqeust;
use App\Http\Requests\Admin\Market\CouponReqeust;
use App\Http\Requests\Admin\Market\PublicDiscoutRequest;
use App\Models\Market\AmazingSale;
use App\Models\Market\Coupon;
use App\Models\Market\Product;
use App\Models\Market\PublicDiscount;
use App\Models\User;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    //coupons
    public function coupon()
    {
        $this->authorize('index', Coupon::class);
        $discounts = Coupon::all();
        return view('admin.market.discount.coupon', compact('discounts'));
    }

    public function couponCreate()
    {
        $this->authorize('create', Coupon::class);
        $users = User::all();
        return view('admin.market.discount.couponCreate', compact('users'));
    }

    public function couponStore(CouponReqeust $request)
    {
        $this->authorize('create', Coupon::class);
        $inputs = $request->all();
        $inputs['valid_from'] = date('Y-m-d', intval(substr($request->valid_from, 0, 10)));
        $inputs['valid_until'] = date('Y-m-d', intval(substr($request->valid_until, 0, 10)));

        if ($inputs['type'] == 0) {
            $inputs["user_id"] = null;
        }

        if ($inputs['amount_type'] == 1) {
            $inputs['maximum_discount'] = $inputs['amount'];
        }

        $discount = Coupon::create($inputs);

        return redirect()->route('admin.market.discount.coupon')->with("alertify-success", "کوپن جدید با موفقیت اضافه شد");
    }

    public function couponEdit(Coupon $discount)
    {
        $this->authorize('update', Coupon::class);
        $users = User::all();
        return view('admin.market.discount.couponEdit', compact('discount', 'users'));
    }

    public function couponUpdate(CouponReqeust $request, Coupon $discount)
    {
        $this->authorize('update', Coupon::class);
        $inputs = $request->all();
        $inputs['valid_from'] = date('Y-m-d', intval(substr($request->valid_from, 0, 10)));
        $inputs['valid_until'] = date('Y-m-d', intval(substr($request->valid_until, 0, 10)));

        if ($inputs['type'] == 0) {
            $inputs["user_id"] = null;
        }
        if ($inputs['amount_type'] == 1) {
            $inputs['maximum_discount'] = $inputs['amount'];
        }

        $discount->update($inputs);

        return redirect()->route('admin.market.discount.coupon')->with("alertify-success", "کوپن موردنظر با موفقیت ویرایش شد");
    }

    public function couponDestroy(Coupon $discount)
    {
        $this->authorize('delete', Coupon::class);
        $discount->delete();
        return redirect()->route('admin.market.discount.coupon')->with("alertify-success", "کوپن موردنظر با موفقیت حذف شد");
    }


    //public discounts
    public function publicDiscount()
    {
        $this->authorize('index', PublicDiscount::class);
        $discounts = PublicDiscount::all();
        return view('admin.market.discount.publicDiscount', compact('discounts'));
    }

    public function publicDiscountCreate()
    {
        $this->authorize('create', PublicDiscount::class);
        return view('admin.market.discount.publicDiscountCreate');
    }
    public function publicDiscountStore(PublicDiscoutRequest $request)
    {
        $this->authorize('create', PublicDiscount::class);
        $inputs = $request->all();
        $inputs['valid_from'] = date('Y-m-d', intval(substr($request->valid_from, 0, 10)));
        $inputs['valid_until'] = date('Y-m-d', intval(substr($request->valid_until, 0, 10)));
        $discount = PublicDiscount::create($inputs);

        return redirect()->route('admin.market.discount.public')->with("alertify-success", "تخفیف جدید با موفقیت اضافه شد");
    }
    public function publicDiscountEdit(PublicDiscount $discount)
    {
        $this->authorize('update', PublicDiscount::class);
        return view('admin.market.discount.publicDiscountEdit', compact('discount'));
    }
    public function publicDiscountUpdate(PublicDiscoutRequest $request, PublicDiscount $discount)
    {
        $this->authorize('update', PublicDiscount::class);
        $inputs = $request->all();
        $inputs['valid_from'] = date('Y-m-d', intval(substr($request->valid_from, 0, 10)));
        $inputs['valid_until'] = date('Y-m-d', intval(substr($request->valid_until, 0, 10)));
        $discount->update($inputs);

        return redirect()->route('admin.market.discount.public')->with("alertify-success", "تخفیف موردنظر با موفقیت ویرایش شد");
    }
    public function publicDiscountDestroy(PublicDiscount $discount)
    {
        $this->authorize('delete', PublicDiscount::class);
        $discount->delete();
        return redirect()->route('admin.market.discount.public')->with("alertify-success", "تخفیف موردنظر با موفقیت حذف شد");
    }



    //amazing sales
    public function amazingDiscount()
    {
        $this->authorize('index', AmazingSale::class);
        $discounts = AmazingSale::all();
        return view('admin.market.discount.amazingDiscount', compact('discounts'));
    }

    public function amazingDiscountCreate()
    {
        $this->authorize('create', AmazingSale::class);
        $products = Product::all();
        return view('admin.market.discount.amazingDiscountCreate', compact('products'));
    }

    public function amazingDiscountStore(AmazingSaleReqeust $request)
    {
        $this->authorize('create', AmazingSale::class);
        $inputs = $request->all();
        $inputs['valid_from'] = date('Y-m-d', intval(substr($request->valid_from, 0, 10)));
        $inputs['valid_until'] = date('Y-m-d', intval(substr($request->valid_until, 0, 10)));
        $discount = AmazingSale::create($inputs);

        return redirect()->route('admin.market.discount.amazing')->with("alertify-success", "تخفیف شگفت انگیز جدید با موفقیت اضافه شد");
    }
    public function amazingDiscountEdit(AmazingSale $discount)
    {
        $this->authorize('update', AmazingSale::class);
        $products = Product::all();
        return view('admin.market.discount.amazingDiscountEdit', compact('discount', 'products'));
    }
    public function amazingDiscountUpdate(AmazingSaleReqeust $request, AmazingSale $discount)
    {
        $this->authorize('update', AmazingSale::class);
        $inputs = $request->all();
        $inputs['valid_from'] = date('Y-m-d', intval(substr($request->valid_from, 0, 10)));
        $inputs['valid_until'] = date('Y-m-d', intval(substr($request->valid_until, 0, 10)));
        $discount->update($inputs);

        return redirect()->route('admin.market.discount.amazing')->with("alertify-success", "تخفیف شگفت انگیز موردنظر با موفقیت ویرایش شد");
    }
    public function amazingDiscountDestroy(AmazingSale $discount)
    {
        $this->authorize('delete', AmazingSale::class);
        $discount->delete();
        return redirect()->route('admin.market.discount.amazing')->with("alertify-success", "تخفیف شگفت انگیز موردنظر با موفقیت حذف شد");
    }
}
