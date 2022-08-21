@extends('app.layouts.master')

@section('content')
    <!-- payment result starts -->
    <section class="grid grid-cols-9 gap-4 mt-4">

        <div class="my-8 col-span-9 flex-center">
            <div
                class="relative flex justify-between items-center w-4/5 h-2 md:h-3 rounded-full bg-gray-100 dark:bg-gray-800">
                <!-- <div class="absolute top-0 right-0 left-1/2 bg-green-600 dark:bg-green-400 h-2 md:h-3 rounded-full"></div> -->
                <div class="absolute top-0 right-0 left-0 bg-green-600 dark:bg-green-400 h-2 md:h-3 rounded-full"></div>
                <span class="rounded-full flex-center bg-green-600 dark:bg-green-400 w-10 h-10 relative">
                    <span class="text-xxs xs:text-xs absolute -top-6 whitespace-nowrap">
                        اطلاعات ارسال
                    </span>
                    <i class="fa-solid fa-check text-base text-white dark:text-gray-800"></i>
                </span>
                <span class="rounded-full flex-center bg-green-600 dark:bg-green-400 w-10 h-10 relative">
                    <span class="text-xxs xs:text-xs absolute -top-6 whitespace-nowrap">
                        پرداخت
                    </span>
                    <i class="fa-solid fa-check text-base text-white dark:text-gray-800"></i>
                </span>
                <!-- <span class="rounded-full flex-center bg-gray-500 w-10 h-10 relative">
                                    <span class="text-xxs xs:text-xs absolute -top-6 whitespace-nowrap">
                                        پرداخت
                                    </span>
                                    <i class="fa-regular fa-xmark text-xs text-gray-800 dark:text-gray-800"></i>
                                </span> -->
                <!-- <span class="rounded-full flex-center bg-gray-100 dark:bg-gray-800 w-10 h-10 relative">
                                    <span class="text-xxs xs:text-xs absolute -top-6 whitespace-nowrap">
                                        اتمام خرید و ارسال
                                    </span>
                                    <i class="fa-regular fa-flag text-xs text-gray-500 dark:text-gray-400"></i>
                                </span> -->
                <span class="rounded-full flex-center bg-green-600 dark:bg-green-400 w-10 h-10 relative">
                    <span class="text-xxs xs:text-xs absolute -top-6 whitespace-nowrap">
                        اتمام خرید و ارسال
                    </span>
                    <i class="fa-solid fa-check text-base text-white dark:text-gray-800"></i>
                </span>
            </div>
        </div>

        @if ($verify == 'true')
            <div
                class="col-span-9 flex flex-col justify-center items-center gap-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">

                <i class="fa-solid fa-circle-check text-7xl md:text-9xl text-green-600 dark:text-green-400"></i>
                <span class="text-lg">پرداخت موفقیت آمیز بود</span>
                <span class="text-sm">از اعتماد شما سپاس گذاریم :)</span>
                <span class="text-sm">کد تراکنش: {{ e2p_numbers($transaction_id) }}</span>
                <a href="{{ route('app.user.orders.details', $order->id) }}"
                    class="text-xs rounded-lg px-3 py-2 bg-gray-200 dark:bg-gray-500 dark:text-white">پیگیری
                    سفارش</a>

            </div>
        @elseif($status === 'OK' && $verify != 'true')
            <div
                class="col-span-9 flex flex-col justify-center items-center gap-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">

                <i class="fa-solid fa-circle-check text-7xl md:text-9xl text-green-600 dark:text-green-400"></i>
                <span class="text-lg">{{$verify}}</span>
                <span class="text-sm">کد تراکنش: {{ e2p_numbers($transaction_id) }}</span>
                <a href="{{ route('app.user.orders.details', $order->id) }}"
                    class="text-xs rounded-lg px-3 py-2 bg-gray-200 dark:bg-gray-500 dark:text-white">پیگیری
                    سفارش</a>

            </div>
        @else
            <div
                class="col-span-9 flex flex-col justify-center items-center gap-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">

                <i class="fa-solid fa-face-frown text-7xl md:text-9xl text-gray-400 dark:text-gray-500"></i>
                <span class="text-base text-gray-500">پرداخت موفقیت آمیز نبود</span>
                <span class="text-base text-red-500">{{ $verify }}</span>
                <span class="text-sm">کد تراکنش: {{ e2p_numbers($transaction_id) }}</span>
                <a href="{{ route('app.user.orders.details', $order->id) }}"
                    class="text-xs rounded-lg px-3 py-2 bg-gray-200 dark:bg-gray-500 dark:text-white">پیگیری
                    سفارش</a>

            </div>
        @endif


    </section>
    <!-- payment result ends -->
@endsection
