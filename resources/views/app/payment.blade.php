@extends('app.layouts.master')
@section('head-tag')
    <meta name="csrf-token" content="{{ Session::token() }}">
    <link rel="stylesheet" href="{{ asset('app-assets/packages/spin-js/spin.css') }}">
@endsection

@section('content')
    <!-- payment starts -->
    <section class="grid grid-cols-9 gap-4 mt-4">

        <div class="my-8 col-span-9 flex-center">
            <div
                class="relative flex justify-between items-center w-4/5 h-2 md:h-3 rounded-full bg-gray-100 dark:bg-gray-800">
                <div class="absolute top-0 right-0 left-1/2 bg-emerald-600 h-2 md:h-3 rounded-full"></div>
                <span class="rounded-full flex-center bg-emerald-600 w-10 h-10 relative">
                    <span class="text-xxs xs:text-xs absolute -top-6 whitespace-nowrap">
                        اطلاعات ارسال
                    </span>
                    <i class="fa-regular fa-check text-xs text-white"></i>
                </span>
                <span class="rounded-full flex-center bg-red-500 w-10 h-10 relative">
                    <span class="text-xxs xs:text-xs absolute -top-6 whitespace-nowrap">
                        پرداخت
                    </span>
                    <i class="fa-regular fa-credit-card text-xs text-white "></i>
                </span>
                <span class="rounded-full flex-center bg-gray-100 dark:bg-gray-800 w-10 h-10 relative">
                    <span class="text-xxs xs:text-xs absolute -top-6 whitespace-nowrap">
                        اتمام خرید و ارسال
                    </span>
                    <i class="fa-regular fa-flag text-xs text-gray-500 dark:text-gray-400"></i>
                </span>
            </div>
        </div>

        <div id="container"
            class="col-span-9 md:col-span-6 lg:col-span-6 lg:h-fit flex flex-col gap-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">
            <span class="text-sm xs:text-base text-gray-500 dark:text-gray-400">
                کد تخفیف دارید؟
            </span>

            <div class="w-full md:w-2/3 grid grid-cols-9 gap-x-2">
                <input class="col-span-7 form-input dark:border-gray-700" type="text" name="discount_code"
                    id="">
                <button id="check-coupon-btn" data-url="{{ route('app.payment.check-coupon', $order->id) }}"
                    class="col-span-2 bg-red-500 rounded-lg text-white text-xs flex-center">
                    اعمال
                </button>
            </div>
            <span id="coupon-message" class="text-xs xs:text-sm text-red-500"></span>
            @if (!empty($order->coupon_id))
            <div id="coupon-container" class="flex gap-2 items-center text-xs xs:text-sm">
                <span class="text-red-500">کوپن: {{ json_decode($order->coupon_object)->code }}</span>
                <a class="text-gray-500 dark:text-gray-400" href="{{ route('app.payment.remove-coupon', [$order->id, $order->coupon_id]) }}">حذف</a>
            </div>
            @endif
            <span class="text-sm xs:text-base text-gray-500 dark:text-gray-400">
                انتخاب شیوه پرداخت
            </span>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <div onclick="selectDelivery(this)"
                    class="col-span-1 rounded-lg cursor-pointer shadow-md p-3 selected-delivery bg-red-500 text-white flex flex-col gap-2">
                    <span class="flex gap-2">
                        <span class="flex gap-2">
                            <i class="fa-solid fa-credit-card text-base"></i>
                            <span class="text-xs">پرداخت آنلاین</span>
                        </span>

                    </span>
                    <span class="text-sm">درگاه زرین پال</span>
                </div>
                <div onclick="selectDelivery(this)"
                    class="col-span-1 rounded-lg cursor-pointer shadow-md p-3 bg-gray-200 dark:bg-gray-700 flex flex-col gap-2">
                    <span class="flex gap-2">
                        <i class="fa-solid fa-hand-holding-dollar text-base"></i>
                        <span class="text-xs">پرداخت در محل</span>
                    </span>
                    <span class="text-sm">پرداخت نقدی به مامور تحویل مرسوله</span>
                </div>
            </div>

        </div>

        <div id="price-container"
            class="col-span-9 md:col-span-3 lg:col-span-3 text-xs md:text-xxs lg:text-xs flex flex-col gap-2 h-fit p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">

            <span class="flex justify-between items-center @if (empty($order->coupon_id)) md:pb-2 md:border-b-2 border-gray-200 dark:border-gray-700 @endif">
                <span>مبلغ سفارش شما</span>
                <span>{{ price_formater($order->order_final_amount) }} تومان</span>
            </span>
            @if (!empty($order->coupon_id))
                <span id="coupon-price-container"
                    class="text-red-500 flex justify-between items-center md:pb-2 md:border-b-2 border-gray-200 dark:border-gray-700">
                    <span>تخفیف</span>
                    <span>{{ price_formater($order->order_coupon_discount_amount) }} تومان</span>
                </span>
            @endif

            <div
                class="fixed drop-shadow-lg right-0 bottom-0 left-0 z-30 md:z-0 flex justify-between items-center md:block md:static bg-gray-200 dark:bg-gray-800 md:bg-transparent p-3 md:p-0">
                @php
                    $payment_amount = !empty($order->coupon_id) ? $order->order_final_amount - $order->order_coupon_discount_amount : $order->order_final_amount;
                @endphp
                <span
                    class="flex flex-col md:flex-row gap-2 md:justify-between items-center text-xxs xs:text-xs md:text-xxs lg:text-xs">
                    <span>مبلغ پرداختی</span>
                    <span>{{ price_formater($payment_amount) }} تومان</span>
                </span>

                <button class="md:w-full px-4 py-2 bg-red-500 text-xxs xs:text-sm rounded-lg mt-2 text-white">
                    پرداخت
                </button>
            </div>

        </div>
    </section>
    <!-- payment ends -->
@endsection
@section('scripts')
    {{-- <script type="module" src="{{ asset('app-assets/packages/spin-js/spin.js') }}"></script> --}}
    <script type="module" src="{{ asset('app-assets/js/payment-page.js') }}"></script>
@endsection
