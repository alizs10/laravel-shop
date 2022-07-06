<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Market\Coupon;
use App\Models\Market\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Prophecy\Call\Call;

class PaymentController extends Controller
{
    public function index(Order $order)
    {
        return view('app.payment', compact('order'));
    }

    public function checkCoupon(Request $request, Order $order)
    {
        $request->validate([
            'discount_code' => "required|string",
        ]);

        $discount_code = $request->get('discount_code');
        $coupon = Coupon::where(
            'code',
            $discount_code
        )->where('valid_until', ">", Carbon::now())->first();

        if (empty($coupon)) {
            return response()->json([
                'status' => false,
                "message" => "کد تخفیف نامعتبر می باشد"
            ]);
        }

        return response()->json([
            'status' => true,
            "message" => "کد تخفیف با موفقیت اعمال شد"
        ]);
    }

    public function result()
    {
        return view('app.payment-result');
    }
}
