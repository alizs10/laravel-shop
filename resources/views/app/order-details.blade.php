@extends('app.layouts.master')

@section('content')
    <!-- breadcrumb starts-->
    <section
        class="px-2 py-4 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white flex flex-wrap items-center gap-1 md:gap-2">

        <a href="" class="text-xs xs:text-sm md:text-base text-red-500">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs xs:text-sm md:text-base text-red-500">پروفایل</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs xs:text-sm md:text-base text-red-500">لیست سفارشات</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs xs:text-sm md:text-base text-red-500">{{ $order->status() }}</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs xs:text-sm md:text-base text-red-500">جزییات سفارش</span>


    </section>
    <!-- breadcrumb ends -->

    <!-- order details starts -->
    <section class="grid grid-cols-9 gap-4 mt-4">


        <div id="orders-section"
            class="lg:block col-span-9 md:col-span-6 lg:h-fit flex flex-col gap-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">
            <span class="flex items-center gap-3">
                <span class="text-sm xs:text-base text-gray-500 dark:text-gray-400">
                    جزییات سفارش
                </span>
            </span>

            <div
                class="my-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 p-3 bg-white dark:bg-gray-700 rounded-lg shadow-md">
                <span class="col-span-1 text-xs leading-7">
                    <span class="text-xxs text-gray-500 dark:text-gray-400">تاریخ ثبت سفارش:</span>
                    {{ e2p_numbers(showPersianDate($order->created_at)) }}
                </span>
                <span class="col-span-1 text-xs leading-7">
                    <span class="text-xxs text-gray-500 dark:text-gray-400">کد سفارش:</span>
                    LSC-{{ $order->id }}
                </span>
                <span class="col-span-1 text-xs leading-7">
                    <span class="text-xxs text-gray-500 dark:text-gray-400">وضعیت سفارش:</span>
                    {{ $order->status() }}
                </span>
                <span class="col-span-1 text-xs leading-7">
                    <span class="text-xxs text-gray-500 dark:text-gray-400">آدرس:</span>

                    {{ $order->address->city->province->name . '، ' . $order->address->city->name . '، ' . $order->address->address }}
                </span>
                <span class="col-span-1 text-xs leading-7">
                    <span class="text-xxs text-gray-500 dark:text-gray-400">نام تحویل گیرنده:</span>
                    {{ json_decode($order->address_object)->receiver_name }}
                </span>
                <span class="col-span-1 text-xs leading-7">
                    <span class="text-xxs text-gray-500 dark:text-gray-400">شماره تماس تحویل گیرنده:</span>
                    {{ e2p_numbers(json_decode($order->address_object)->receiver_mobile) }}
                </span>
            </div>

            <span class="text-sm xs:text-base text-gray-500 dark:text-gray-400">
                لیست کالاها
            </span>

            <div class="flex flex-col gap-2 mt-2">

                @foreach ($order->items as $order_item)
                    <div class="grid grid-cols-9 gap-3 p-3 bg-white dark:bg-gray-700 rounded-lg shadow-md">

                        <div class="col-span-4 xs:col-span-3 lg:col-span-2 h-fit flex flex-col gap-2">
                            <a href="{{ route('app.product.index', $order_item->product_id) }}"
                                class="w-full rounded-lg overflow-hidden">
                                <img src="{{ asset('storage\\' . $order_item->product->image['indexArray']['medium']) }}"
                                    alt="">
                            </a>

                            <span class="text-center mt-2">تعداد: {{ e2p_numbers($order_item->number) }}</span>
                        </div>

                        <div class="col-span-5 xs:col-span-6 lg:col-span-7 flex flex-col gap-2">
                            <span class="text-xs xs:text-sm text-bold">{{ $order_item->product->name }}</span>

                            @foreach ($order_item->orderItemSelectedAttributes as $selected_attribute)
                                <span
                                    class="mt-2 flex gap-x-2 items-center text-xxxs xs:text-xs lg:text-xs text-gray-500 dark:text-gray-400">
                                    <span class="flex gap-x-1 items-center">
                                        <i class="fa-regular fa-circle-small text-xxs xs:text-sm lg:text-base"></i>
                                        {{ $selected_attribute->attribute->name }}:
                                    </span>

                                    <span>{{ json_decode($selected_attribute->value)->value . ' ' . $selected_attribute->attribute->unit }}</span>
                                </span>
                            @endforeach

                            @if (!empty($order_item->color_id))
                                <span
                                    class="flex gap-x-2 items-center text-gray-500 dark:text-gray-400 text-xxxs xs:text-xs lg:text-xs">
                                    <span class="flex gap-x-1 items-center">
                                        <i class="fa-regular fa-palette text-xxs xs:text-sm lg:text-base"></i>
                                    </span>

                                    <span class="flex gap-2">رنگ:
                                        <span class="flex gap-2 items-center">
                                            <span style="background-color: {{ '#' . $order_item->color->color_code }}"
                                                class="p-1 rounded-full"></span>
                                            <span>{{ $order_item->color->color_name }}</span>
                                        </span>
                                    </span>
                                </span>
                            @endif
                            <span
                                class="flex gap-x-2 items-center text-gray-500 dark:text-gray-400 text-xxxs xs:text-xs lg:text-xs">
                                <span class="flex gap-x-1 items-center">
                                    <i class="fa-regular fa-calendar-week text-xxs xs:text-sm lg:text-base"></i>

                                </span>

                                <span>ضمانت 7 روزه بازگشت کالا</span>
                            </span>
                            <span
                                class="flex gap-x-2 items-center text-gray-500 dark:text-gray-400 text-xxxs xs:text-xs lg:text-xs">
                                <span class="flex gap-x-1 items-center">
                                    <i class="fa-regular fa-shield-check text-xxs xs:text-sm lg:text-base"></i>

                                </span>

                                <span>گارانتی اصالات و سلامت فیزیکی کالا</span>
                            </span>



                            <span class="mt-4 flex flex-col gap-2">
                                @php
                                    
                                    $product_price = $order_item->product->price;
                                    
                                    //check for product color price increase
                                    if (!empty($order_item->color)) {
                                        $product_price += $order_item->color->price_increase;
                                    }
                                    
                                    //check for product attributes price increase
                                    if (!empty($order_item->orderItemSelectedAttributes)) {
                                        foreach ($order_item->orderItemSelectedAttributes as $selected_attribute) {
                                            $product_price += json_decode($selected_attribute->value)->price_increase;
                                        }
                                    }
                                    
                                    $final_product_price = $product_price * $order_item->number;
                                    
                                    if (!empty($order_item->product->amazingSale)) {
                                        $discount_amount = ($order_item->product->amazingSale->percentage * $final_product_price) / 100;
                                    } else {
                                        $discount_amount = 0;
                                    }
                                    
                                    $ultimate_price = $final_product_price - $discount_amount;
                                @endphp
                                @if (!empty($order_item->product->amazingSale))
                                    <span id="discount-amount-{{ $order_item->id }}"
                                        class="text-red-500 text-xxs xs:text-xs lg:text-sm">
                                        تخفیف {{ price_formater($discount_amount) }} تومان
                                    </span>
                                @endif

                                <span id="ultimate-price-{{ $order_item->id }}"
                                    class="text-black dark:text-white text-xs xs:text-base">
                                    {{ price_formater($ultimate_price) }} تومان
                                </span>
                            </span>


                        </div>

                    </div>
                @endforeach


            </div>

        </div>

        <div
            class="col-span-9 md:col-span-3 text-xs md:text-xxs lg:text-xs flex flex-col gap-2 h-fit p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">

            <span class="flex justify-between items-center">
                <span>مبلغ مجموع کالاها</span>
                <span>{{ price_formater($order->order_final_amount) }} تومان</span>
            </span>
            @if (!empty($order->coupon_id))
                <span
                    class="text-red-500 flex justify-between items-center md:pb-2 md:border-b-2 border-gray-200 dark:border-gray-700">
                    <span>تخفیف</span>
                    <span>{{ price_formater($order->order_coupon_discount_amount) }} تومان</span>
                </span>
            @endif

            <span class="flex justify-between items-center">
                <span>هزینه ارسال</span>
                <span>{{ price_formater($order->delivery_amount) }} تومان</span>
            </span>

            <div
                class="fixed drop-shadow-lg right-0 bottom-0 left-0 z-30 md:z-0 flex justify-between items-center md:block md:static bg-gray-200 dark:bg-gray-800 md:bg-transparent p-3 md:p-0">
                <span
                    class="flex flex-col md:flex-row gap-2 md:justify-between items-center text-xxs xs:text-xs md:text-xxs lg:text-xs">
                    <span>مبلغ پرداختی</span>
                    <span>{{ price_formater($order->order_final_amount + $order->delivery_amount - ($order->order_coupon_discount_amount ?? 0)) }}
                        تومان</span>
                </span>
                @if ($order->order_status == 0)
                    <a href="{{ route('app.shipping.index', $order->id) }}"
                        class="md:w-full flex-center gap-2 px-4 py-2 bg-red-500 text-xxs xs:text-sm rounded-lg mt-2 text-white">
                        پرداخت
                    </a>
                @else
                    <a href="{{ route('app.user.orders.factor', $order->id) }}" target="_blank"
                        class="md:w-full flex-center gap-2 px-4 py-2 bg-gray-500 text-xxs xs:text-sm rounded-lg mt-2 text-white">
                        <i class="fa-light fa-receipt text-base"></i>
                        مشاهده فاکتور
                    </a>
                @endif

            </div>

            @if ($order->order_status == 0)
                <a href="{{ route('app.user.orders.factor', $order->id) }}" target="_blank"
                    class="md:w-full flex-center gap-2 px-4 py-2 bg-gray-500 text-xxs xs:text-sm rounded-lg mt-2 text-white">
                    <i class="fa-light fa-receipt text-base"></i>
                    مشاهده فاکتور
                </a>
            @endif

        </div>
    </section>
    <!-- order details ends -->
@endsection
