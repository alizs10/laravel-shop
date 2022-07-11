<?php

namespace App\Http\Services;

use App\Models\Market\OnlinePayment;
use App\Models\Market\Payment as MarketPayment;
use App\Models\Payment as ModelsPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
// At the top of the file.
use Shetabit\Multipay\Invoice;
use Shetabit\Multipay\Payment;

class PaymentServices
{
    public function payment($online_payment)
    {
        // load the config file from your project
        $paymentConfig = require(__DIR__ . '/../../../config/payment.php');
        $payment = new Payment($paymentConfig);

        // Create new invoice.
        $invoice = (new Invoice)->amount($online_payment->amount);
        $url = route('app.payment.result');

        // Purchase the given invoice.
        return $payment->callbackUrl($url)->purchase(
            $invoice,
            function ($driver, $transactionId) use ($online_payment) {
                // We can store $transactionId in database.
                $online_payment->update(['transaction_id' => $transactionId]);
            }
        )->pay()->render();
    }

    public function verifyPayment($transaction_id)
    {
        $online_payment = OnlinePayment::where("transaction_id", $transaction_id)->first();

        // load the config file from your project
        $paymentConfig = require(__DIR__ . '/../../../config/payment.php');
        $payment = new Payment($paymentConfig);

        try {
            $receipt = $payment->amount($online_payment->amount)->transactionId($online_payment->transaction_id)->verify();
            $ref_id = $receipt->getReferenceId();
            $online_payment->update([
                "reference_id" => $ref_id,
                "status" => 1
            ]);

            $payment_obj = $online_payment->payment()->first();
            $payment_obj->update([
                "status" => 1
            ]);
        
            $payment_obj->order()->update([
                "payment_status" => 1,
                "order_status" => 1
            ]);

            foreach ($payment_obj->order->items as $order_item) {
                $attributes = $order_item->itemAttributes();
                $productServices = new ProductServices();
                $productServices->sold($attributes);
            }

            return true;
        } catch (InvalidPaymentException $exception) {
            return $exception->getMessage();
        }
    }
}
