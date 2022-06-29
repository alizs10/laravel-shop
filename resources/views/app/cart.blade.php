@extends('app.layouts.master')

@section('content')
    <!-- breadcrumb starts-->
    <section
        class="px-2 py-4 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white flex flex-wrap items-center gap-1 md:gap-2">
        <a href="" class="text-xs xs:text-sm md:text-base text-red-500">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs xs:text-sm md:text-base text-red-500">سبد خرید</span>

    </section>
    <!-- breadcrumb ends -->

    <!-- cart starts -->
    <section class="grid grid-cols-9 gap-4 mt-4">


        <div
            class="@if (count($cart_items) > 0) col-span-9 md:col-span-6 lg:col-span-6 @else col-span-9 @endif lg:h-fit flex flex-col gap-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">
            <span class="flex items-center gap-3">
                <span class="text-sm xs:text-base text-gray-500 dark:text-gray-400">
                    سبد خرید شما
                </span>

                <span class="text-xs text-red-500">
                    @if (count($cart_items) > 0)
                        ({{ e2p_numbers(count($cart_items)) }} کالا)
                    @else
                        (خالی)
                    @endif
                </span>
            </span>

            <div class="flex @if (count($cart_items) > 0) flex-col gap-2 @else flex-center @endif mt-2">

                @if (count($cart_items) > 0)
                    @foreach ($cart_items as $cart_item)
                        <div class="grid grid-cols-9 gap-3 p-3 bg-white dark:bg-gray-700 rounded-lg shadow-md">

                            <div class="col-span-4 xs:col-span-3 lg:col-span-2 h-fit flex flex-col gap-2">
                                <a href="{{ route('app.product.index', $cart_item->product_id) }}"
                                    class="w-full rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage\\' . $cart_item->product->image['indexArray']['medium']) }}"
                                        alt="">
                                </a>

                                <div
                                    class="p-1 lg:mx-4 rounded-lg border-2 border-gray-200 dark:border-gray-500 grid grid-cols-7">
                                    <button id="cart-plus-btn" onclick="cartPlus(this,{{ $cart_item->product_id }})"
                                        data-url="{{ route('app.cart.increment', $cart_item->id) }}"
                                        class="col-span-2 bg-red-500 shadow-md rounded-lg h-6 xs:h-10 text-xxs xs:text-sm flex-center text-white">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                    <div class="col-span-3">
                                        <input class="w-full h-full bg-transparent text-center focus:outline-none"
                                            type="text" name="quantity" id="cart-product-{{ $cart_item->product_id }}"
                                            value="{{ e2p_numbers($cart_item->number) }}" readonly>
                                    </div>
                                    <button id="cart-minus-btn" onclick="cartMinus(this,{{ $cart_item->product_id }})"
                                        data-url="{{ route('app.cart.decrement', $cart_item->id) }}"
                                        class="col-span-2 bg-red-500 shadow-md rounded-lg h-6 xs:h-10 text-xxs xs:text-sm flex-center text-white">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                </div>
                                <a href="{{ route('app.cart.destroy', $cart_item->id) }}"
                                    class="flex gap-2 text-xxs xs:text-xs flex-center text-gray-500 dark:text-gray-400">
                                    <i class="fa-light fa-trash-alt"></i>
                                    حذف از سبدخرید
                                </a>
                            </div>

                            <div class="col-span-5 xs:col-span-6 lg:col-span-7 flex flex-col gap-2">
                                <span class="text-xs xs:text-sm text-bold">{{ $cart_item->product->name }}</span>

                                @foreach ($cart_item->cartItemSelectedAttributes as $selected_attribute)
                                    <span
                                        class="mt-2 flex gap-x-2 items-center text-xxxs xs:text-xs lg:text-xs text-gray-500 dark:text-gray-400">
                                        <span class="flex gap-x-1 items-center">
                                            <i class="fa-regular fa-circle-small text-xxs xs:text-sm lg:text-base"></i>
                                            {{ $selected_attribute->attribute->name }}:
                                        </span>

                                        <span>{{ json_decode($selected_attribute->value)->value }}</span>
                                    </span>
                                @endforeach

                                @if (!empty($cart_item->color_id))
                                    <span
                                        class="flex gap-x-2 items-center text-gray-500 dark:text-gray-400 text-xxxs xs:text-xs lg:text-xs">
                                        <span class="flex gap-x-1 items-center">
                                            <i class="fa-regular fa-palette text-xxs xs:text-sm lg:text-base"></i>
                                        </span>

                                        <span class="flex gap-2">رنگ:
                                            <span class="flex gap-2 items-center">
                                                <span style="background-color: {{ '#' . $cart_item->color->color_code }}"
                                                    class="p-1 rounded-full"></span>
                                                <span>{{ $cart_item->color->color_name }}</span>
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
                                @if ($cart_item->product->marketable_number > 0)
                                    <span
                                        class="mt-2 flex gap-x-2 items-center text-xxs xs:text-xs lg:text-sm font-bold text-emerald-700 dark:text-emerald-600">
                                        <span class="flex gap-x-1 items-center">
                                            <i class="fa-regular fa-check-double text-xxs xs:text-sm lg:text-base"></i>

                                        </span>

                                        <span>موجود در انبار</span>
                                    </span>
                                @else
                                    <span
                                        class="mt-2 flex gap-x-2 items-center text-xxs xs:text-xs lg:text-sm font-bold text-red-500">
                                        <span class="flex gap-x-1 items-center">
                                            <i class="fa-regular fa-xmark text-xxs xs:text-sm lg:text-base"></i>

                                        </span>

                                        <span>ناموجود</span>
                                    </span>
                                @endif


                                <span class="mt-4 flex flex-col gap-2">
                                    @php
                                        
                                        $product_price = $cart_item->product->price;
                                        
                                        //check for product color price increase
                                        if (!empty($cart_item->color)) {
                                            $product_price += $cart_item->color->price_increase;
                                        }
                                        
                                        //check for product attributes price increase
                                        if (!empty($cart_item->cartItemSelectedAttributes)) {
                                            foreach ($cart_item->cartItemSelectedAttributes as $selected_attribute) {
                                                $product_price += json_decode($selected_attribute->value)->price_increase;
                                            }
                                        }
                                        
                                        $final_product_price = $product_price * $cart_item->number;
                                        
                                        if (!empty($cart_item->product->amazingSale)) {
                                            $discount_amount = ($cart_item->product->amazingSale->percentage * $final_product_price) / 100;
                                        } else {
                                            $discount_amount = 0;
                                        }
                                        
                                        $ultimate_price = $final_product_price - $discount_amount;
                                    @endphp
                                    @if (!empty($cart_item->product->amazingSale))
                                        <span class="text-red-500 text-xxs xs:text-xs lg:text-sm">
                                            تخفیف {{ price_formater($discount_amount) }} تومان
                                        </span>
                                    @endif

                                    <span class="text-black dark:text-white text-xs xs:text-base">
                                        {{ price_formater($ultimate_price) }} تومان
                                    </span>
                                </span>


                            </div>

                        </div>
                    @endforeach
                @else
                    <span class="py-3 flex flex-col justify-center gap-3 text-gray-500 dark:text-gray-500">
                        <i class="fa-light fa-cart-circle-xmark text-9xl"></i>
                        <span class="mt-2 text-xs text-center">سبد خرید شما خالیه</span>
                    </span>
                @endif


            </div>

        </div>
        @if (count($cart_items) > 0)
            <div
                class="col-span-9 md:col-span-3 lg:col-span-3 text-xs md:text-xxs lg:text-xs flex flex-col gap-2 h-fit p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">

                @php
                    $pay_price = 0;
                    $discount_price = 0;
                    foreach ($cart_items as $cart_item) {
                        $product_price = $cart_item->product->price;
                        
                        //check for product color price increase
                        if (!empty($cart_item->color)) {
                            $product_price += $cart_item->color->price_increase;
                        }
                    
                        //check for product attributes price increase
                        if (!empty($cart_item->cartItemSelectedAttributes)) {
                            foreach ($cart_item->cartItemSelectedAttributes as $selected_attribute) {
                                $product_price += json_decode($selected_attribute->value)->price_increase;
                            }
                        }
                    
                        $pay_price += $product_price * $cart_item->number;
                    
                        if (!empty($cart_item->product->amazingSale)) {
                            $discount_price = +($cart_item->product->amazingSale->first()->percentage * $product_price * $cart_item->number) / 100;
                        }
                    }
                    
                    $total_pay_price = $pay_price - $discount_price;
                @endphp
                <span class="flex justify-between items-center">
                    <span>جمع سبد خرید شما</span>
                    <span id="pay_price">{{ price_formater($pay_price) }} تومان</span>
                </span>
                <span
                    class="text-red-500 flex justify-between items-center md:pb-2 md:border-b-2 border-gray-200 dark:border-gray-700">
                    <span>سود شما از این خرید</span>
                    <span id="discount_price">{{ price_formater($discount_price) }} تومان</span>
                </span>

                <div
                    class="fixed drop-shadow-lg right-0 bottom-0 left-0 z-30 md:z-0 flex justify-between items-center md:block md:static bg-gray-200 dark:bg-gray-800 md:bg-transparent p-3 md:p-0">
                    <span
                        class="flex flex-col md:flex-row gap-2 md:justify-between items-center text-xxs xs:text-xs md:text-xxs lg:text-xs">
                        <span>مبلغ پرداختی</span>
                        <span id="total_pay_price">{{ price_formater($total_pay_price) }} تومان</span>
                    </span>

                    <form action="{{ route('app.cart.store-order') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="md:w-full px-4 py-2 bg-red-500 text-xxs xs:text-sm rounded-lg mt-2 text-white">ثبت
                            سفارش و ادامه</button>
                    </form>
                </div>

            </div>
        @endif
    </section>
    <!-- cart ends -->

    @if (count($related_products) > 0)
        <!-- related products starts -->
        <section class="flex flex-col gap-y-2 p-2 rounded-lg mt-4 bg-gray-100 dark:bg-gray-800 text-white">
            <div class="flex justify-between items-center text-black dark:text-white text-base">
                <span>کالاهای مرتبط</span>
                <a href="" class="flex-center gap-x-2">
                    <span>بیشتر</span>
                    <i class="fa-duotone fa-arrow-left text-base"></i>
                </a>
            </div>

            <div class="flex flex-row gap-x-2 overflow-x-scroll no-scrollbar">

                @foreach ($related_products as $relatedProduct)
                    <div class="flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
                        <a class="w-32" href="{{ route('app.product.index', $relatedProduct->id) }}">
                            <img src="{{ asset('storage\\' . $relatedProduct->image['indexArray']['medium']) }}"
                                alt="">
                        </a>
                        <div class="flex justify-between items-center">
                            @if (!is_null($relatedProduct->amazingSale))
                                <span class="flex flex-col gap-y-1 text-xs">
                                    <span class="flex gap-x-2 items-center">
                                        <span class="line-through">{{ $relatedProduct->price }}</span>
                                        <div class="h-7 w-7 rounded-lg bg-red-600 text-white flex-center text-xs">
                                            {{ $relatedProduct->amazingSale->percentage }}%</div>
                                    </span>
                                    <span class="text-red-500 font-bold">{{ $relatedProduct->amazingSale->price }}</span>
                                    <span class="text-red-500 font-bold">تومان</span>
                                </span>
                            @else
                                <span class="flex flex-col gap-y-1 text-xs">
                                    <span>{{ $relatedProduct->price }}</span>
                                    <span class="font-bold">تومان</span>
                                </span>
                            @endif

                            <div class="flex flex-col items-center gax-y-2">
                                <button onclick="addToFavorites(this)"
                                    class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <button onclick="addToCart(this)"
                                    class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                                    <i class="fa-solid fa-cart-circle-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
        </section>
        <!-- related products ends -->
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('app-assets/js/cart-page.js') }}"></script>
@endsection
