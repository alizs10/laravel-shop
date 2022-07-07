<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Http\Services\PaymentServices;
use App\Models\Market\Coupon;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Order;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        //check if coupon's used before
        $user = Auth::user();

        if ($coupon->type == 1 && $coupon->user_id != $user->id) {
            return response()->json([
                'status' => false,
                "message" => "این کد تخفیف برای شما قابل استفاده نمی باشد"
            ]);
        }

        $used_coupon = $user->coupons()->where('code', $discount_code)->first();
        if (!empty($used_coupon)) {
            return response()->json([
                'status' => false,
                "message" => "کد تخفیف قبلا استفاده شده است"
            ]);
        }

        if ($coupon->amount_type == 0) {
            $discount_amount = $order->order_final_amount * $coupon->amount / 100;
        } else {
            $discount_amount = $order->order_final_amount - $coupon->amount;
        }
        $discount_amount = $coupon->maximum_discount > $discount_amount ? $discount_amount : $coupon->maximum_discount;


        $orderInputs['coupon_id'] = $coupon->id;
        $orderInputs['coupon_object'] = $coupon;
        $orderInputs['order_coupon_discount_amount'] = $discount_amount;
        $user->coupons()->attach(["coupon_id" => $coupon->id]);
        $order->update($orderInputs);

        return response()->json([
            'status' => true,
            "message" => "کد تخفیف با موفقیت اعمال شد",
            "discount_amount" => $discount_amount,
            "order" => $order,
            "coupon" => $coupon,
            "order_coupon_discount_amount" => price_formater($discount_amount)
        ]);
    }

    public function removeCoupon(Order $order, Coupon $coupon)
    {

        $user = Auth::user();
        if ($order->user_id != $user->id) {
            return redirect()->back();
            exit;
        }
        $user->coupons()->detach(["coupon_id" => $coupon->id]);
        $order->update([
            "coupon_id" => null,
            "coupon_object" => null,
            "order_coupon_discount_amount" => null,
        ]);


        return redirect()->route('app.payment.index', $order->id);
    }

    public function store(Order $order, PaymentServices $paymentServices)
    {
        if ($order->payment_type == 0) {
            $paymentInput["type"] = 0;
            $paymentInput["amount"] = $order->order_final_amount - ($order->order_coupon_discount_amount ?? 0);
            $paymentInput["user_id"] = $order->user_id;
            $paymentInput["gateway"] = "زرین پال";
            $online_payment = OnlinePayment::create($paymentInput);
            $order->payment->update([
                "paymentable_id" => $online_payment->id,
                "paymentable_type" => OnlinePayment::class,
            ]);
        }

        return $paymentServices->payment($online_payment);
    }

    public function result(Request $request, PaymentServices $paymentServices)
    {
        
        $transaction_id = $request->get('Authority');
        $status = $request->get('Status');

        $verify = $paymentServices->verifyPayment($transaction_id);
        if ($verify === true) {
            dd("yep");
        }
        return view('app.payment-result');
    }
}
