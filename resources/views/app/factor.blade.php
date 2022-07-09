<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('app-assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/packages/fontawesome/css/all.min.css') }}" />
    <title>فاکتور خرید LSC-{{ $order->id }}</title>
</head>

<body class="rtl">
    <div class="flex justify-end ml-8 mt-2">
        <button onclick="window.print()" class="px-3 py-3 text-base text-black">
            <i class="fa-regular fa-print"></i>
        </button>
    </div>
    <div class="mx-8 mt-4 border border-black flex flex-col rounded-lg">
        <h1 class="text-sm font-bold text-center w-full py-2 border-b border-black">مشخصات فروشنده</h1>
        <div class="text-xs grid grid-cols-3 border-b border-black">
            <span class="py-2 mr-2">نام شخص/شرکت:
                فروشگاه اینترنتی لاراول
            </span>
            <span class="border-r border-black py-2 pr-2">

                شماره اقتصادی: 135468431
            </span>
            <span class="border-r border-black py-2 pr-2">

                شماره شناسه ملی: 0002165
            </span>
        </div>
        <div class="text-xs grid grid-cols-3 border-b border-black">
            <span class="py-2 mr-2">
                نام استان: تهران
            </span>
            <span class="border-r border-black py-2 pr-2">

                شهرستان: تهران
            </span>
            <span class="border-r border-black py-2 pr-2">

                شماره ثبت: 7865
            </span>

        </div>
        <div class="text-xs grid grid-cols-3">
            <span class="py-2 mr-2">
                کد پستی: 64789456325
            </span>
            <span class="border-r border-black py-2 pr-2">
                نشانی: شهرک صنغتی دوم، میدان اول، خیابان دوم شرقی
            </span>
            <span class="border-r border-black py-2 pr-2">
                شماره تماس: 021-45687920
            </span>
        </div>
        <h1 class="text-sm font-bold text-center w-full py-2 border-y border-black">مشخصات خریدار</h1>
        <div class="text-xs grid grid-cols-3 border-b border-black">
            <span class="py-2 mr-2">
                نام و نام خانوادگی: {{ $order->user->fullName }}
            </span>
            <span class="border-r border-black py-2 pr-2">

                شماره شناسه نامه: {{ e2p_numbers($order->user->national_code) }}
            </span>
            <span class="border-r border-black py-2 pr-2">

                نام استان: {{ $order->address->city->province->name }}
            </span>
        </div>
        <div class="text-xs grid grid-cols-3 border-b border-black">
            <span class="py-2 mr-2">
                شهرستان: {{ $order->address->city->name }}
            </span>
            <span class="border-r border-black py-2 pr-2">

                نشانی: {{ $order->address->address }}
            </span>
            <span class="border-r border-black py-2 pr-2">
                واحد: {{ $order->address->unit ? e2p_numbers($order->address->unit) : '-' }}
            </span>

        </div>
        <div class="text-xs grid grid-cols-3">
            <span class="py-2 mr-2">

                پلاک: {{ e2p_numbers($order->address->no) }}
            </span>
            <span class="border-r border-black py-2 pr-2">
                کد پستی: {{ e2p_numbers($order->address->postal_code) }}
            </span>
            <span class="border-r border-black py-2 pr-2">
                نام و نام خانوادگی تحویل گیرنده: {{ $order->address->receiver_name }}
            </span>
        </div>
        <div class="text-xs grid grid-cols-3 border-t border-black">
            <span class="py-2 mr-2">
                شماره تماس تحویل گیرنده: {{ e2p_numbers($order->address->receiver_mobile) }}
            </span>
        </div>
        <h1 class="text-sm font-bold text-center w-full py-2 border-y border-black">مشخصات کالاها</h1>
        <div class="text-xs font-bold grid grid-cols-12">
            <span class="col-span-3 py-2 mr-2">
                نام کالا
            </span>
            <span class="col-span-1 border-r border-black py-2 pr-2">
                تعداد
            </span>
            <span class="col-span-2 border-r border-black py-2 pr-2">
                قیمت واحد
            </span>
            <span class="col-span-2 border-r border-black py-2 pr-2">
                تخفیف
            </span>
            <span class="col-span-2 border-r border-black py-2 pr-2">
                قیمت پس از تخفیف
            </span>
            <span class="col-span-2 border-r border-black py-2 pr-2">
                قیمت کل
            </span>
        </div>
        @php
            $order_numbers = 0;
            $all_final_products_price = 0;
            $all_discounts = 0;
        @endphp
        @foreach ($order->items as $item)
            @php
                $order_numbers += $item->number;
                $all_final_products_price += $item->final_product_price;
                $all_discounts += $item->product_unit_price - $item->final_product_price;
            @endphp
            <div class="text-xs grid grid-cols-12 border-t border-black">
                <span class="col-span-3 py-2 mr-2">
                    {{ $item->product->name }}
                </span>
                <span class="col-span-1 border-r border-black py-2 pr-2">
                    {{ e2p_numbers($item->number) }}
                </span>
                <span class="col-span-2 border-r border-black py-2 pr-2">
                    {{ price_formater($item->product_unit_price) }} تومان
                </span>
                <span class="col-span-2 border-r border-black py-2 pr-2">
                    {{ price_formater($item->product_unit_price - $item->final_product_price) }} تومان
                </span>
                <span class="col-span-2 border-r border-black py-2 pr-2">
                    {{ price_formater($item->final_product_price) }} تومان
                </span>
                <span class="col-span-2 border-r border-black py-2 pr-2">
                    {{ price_formater($item->final_total_price) }} تومان
                </span>
            </div>
        @endforeach

        <div class="text-xs grid grid-cols-12 border-t border-black font-bold">
            <span class="col-span-3 py-2 mr-2">
                جمع
            </span>
            <span class="col-span-1 border-r border-black py-2 pr-2">
                {{ e2p_numbers($order_numbers) }}
            </span>
            <span class="col-span-2 border-r border-black py-2 pr-2">
                -
            </span>
            <span class="col-span-2 border-r border-black py-2 pr-2">
                {{ price_formater($all_discounts) }} تومان
            </span>
            <span class="col-span-2 border-r border-black py-2 pr-2">
                {{ price_formater($all_final_products_price) }} تومان
            </span>
            <span class="col-span-2 border-r border-black py-2 pr-2">
                {{ price_formater($order->order_final_amount) }} تومان
            </span>
        </div>
    </div>




</body>

</html>
