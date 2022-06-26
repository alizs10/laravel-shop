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
                class="col-span-9 md:col-span-6 lg:col-span-6 lg:h-fit flex flex-col gap-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">
                <span class="flex items-center gap-3">
                    <span class="text-sm xs:text-base text-gray-500 dark:text-gray-400">
                        سبد خرید شما
                    </span>

                    <span class="text-xs text-red-500">
                        (۲ کالا)
                    </span>
                </span>

                <div class="flex flex-col gap-2 mt-2">

                    <div class="grid grid-cols-9 gap-3 p-3 bg-white dark:bg-gray-700 rounded-lg shadow-md">

                        <div class="col-span-4 xs:col-span-3 lg:col-span-2 h-fit flex flex-col gap-2">
                            <a href="" class="w-full rounded-lg overflow-hidden">
                                <img src="../images/product-2.webp" alt="">
                            </a>

                            <div class="p-1 lg:mx-4 rounded-lg border-2 border-gray-200 dark:border-gray-500 grid grid-cols-7">
                                <button id="cart-plus-btn" onclick="cartPlus(1)"
                                    class="col-span-2 bg-red-500 shadow-md rounded-lg h-6 xs:h-10 text-xxs xs:text-sm flex-center text-white">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                                <div class="col-span-3">
                                    <input class="w-full h-full bg-transparent text-center focus:outline-none"
                                        type="text" name="quantity" id="cart-product-1" value="۱" min="1" id="" readonly>
                                </div>
                                <button id="cart-minus-btn" onclick="cartMinus(1)"
                                    class="col-span-2 bg-red-500 shadow-md rounded-lg h-6 xs:h-10 text-xxs xs:text-sm flex-center text-white">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            </div>
                            <button class="flex gap-2 text-xxs xs:text-xs flex-center text-gray-500 dark:text-gray-400">
                                <i class="fa-light fa-trash-alt"></i>
                                حذف از سبدخرید
                            </button>
                        </div>

                        <div class="col-span-5 xs:col-span-6 lg:col-span-7 flex flex-col gap-2">
                            <span class="text-xs xs:text-sm text-bold">گوشی سامسونگ گلکسی S22 اولترا</span>
                            <span
                                class="mt-2 flex gap-x-2 items-center text-xxxs xs:text-xs lg:text-xs text-gray-500 dark:text-gray-400">
                                <span class="flex gap-x-1 items-center">
                                    <i class="fa-regular fa-circle-small text-xxs xs:text-sm lg:text-base"></i>
                                    حافظه داخلی:
                                </span>

                                <span>512 گیگابایت</span>
                            </span>
                            <span
                                class="flex gap-x-2 items-center text-xxxs xs:text-xs lg:text-xs text-gray-500 dark:text-gray-400">
                                <span class="flex gap-x-1 items-center">
                                    <i class="fa-regular fa-circle-small text-xxs xs:text-sm lg:text-base"></i>
                                    مقدار رم:
                                </span>

                                <span>12 گیگابایت</span>
                            </span>
                            <span
                                class="flex gap-x-2 items-center text-gray-500 dark:text-gray-400 text-xxxs xs:text-xs lg:text-xs">
                                <span class="flex gap-x-1 items-center">
                                    <i class="fa-regular fa-palette text-xxs xs:text-sm lg:text-base"></i>
                                </span>

                                <span class="flex gap-2">رنگ:
                                    <span class="flex gap-2 items-center">
                                        <span class="p-1 rounded-full bg-black"></span>
                                        <span>مشکی</span>
                                    </span>
                                </span>
                            </span>
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
                            <span
                                class="mt-2 flex gap-x-2 items-center text-xxs xs:text-xs lg:text-sm font-bold text-emerald-700 dark:text-emerald-600">
                                <span class="flex gap-x-1 items-center">
                                    <i class="fa-regular fa-check-double text-xxs xs:text-sm lg:text-base"></i>

                                </span>

                                <span>موجود در انبار</span>
                            </span>

                            <span class="mt-4 flex flex-col gap-2">
                                <span class="text-red-500 text-xxs xs:text-xs lg:text-sm">
                                    تخفیف ۲۸٬۲۰۰ تومان
                                </span>
                                <span class="text-black dark:text-white text-xs xs:text-base">
                                    ۴۲۸٬۲۰۰ تومان
                                </span>
                            </span>

                           
                        </div>

                    </div>


                </div>

            </div>

            <div
                class="col-span-9 md:col-span-3 lg:col-span-3 text-xs md:text-xxs lg:text-xs flex flex-col gap-2 h-fit p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">

                <span class="flex justify-between items-center">
                    <span>جمع سبد خرید شما</span>
                    <span>۴۲۸٬۴۵۰ تومان</span>
                </span>
                <span
                    class="text-red-500 flex justify-between items-center md:pb-2 md:border-b-2 border-gray-200 dark:border-gray-700">
                    <span>سود شما از این خرید</span>
                    <span>۲۸٬۴۵۰ تومان</span>
                </span>

                <div class="fixed drop-shadow-lg right-0 bottom-0 left-0 z-30 md:z-0 flex justify-between items-center md:block md:static bg-gray-200 dark:bg-gray-800 md:bg-transparent p-3 md:p-0">
                    <span class="flex flex-col md:flex-row gap-2 md:justify-between items-center text-xxs xs:text-xs md:text-xxs lg:text-xs">
                        <span>مبلغ پرداختی</span>
                        <span>۴۰۱٬۲۰۰ تومان</span>
                    </span>

                    <button
                        class="md:w-full px-4 py-2 bg-red-500 text-xxs xs:text-sm rounded-lg mt-2 text-white">ثبت
                        سفارش و ادامه</button>
                </div>

            </div>
        </section>
        <!-- cart ends -->

            <!-- recommended products starts -->
            <section class="flex flex-col gap-y-2 p-2 rounded-lg mt-4 bg-gray-100 dark:bg-gray-800 text-white">
                <div class="flex justify-between items-center text-black dark:text-white text-base">
                    <span>پیشنهاد لاراول به شما</span>
                    <a href="" class="flex-center gap-x-2">
                        <span>بیشتر</span>
                        <i class="fa-duotone fa-arrow-left text-base"></i>
                    </a>
                </div>
    
                <div class="flex flex-row gap-x-2 overflow-x-scroll no-scrollbar">
    
                    <div class="flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
                        <img class="w-32" src="../images/product-1.jfif" alt="">
                        <div class="flex justify-between items-center">
                            <span class="flex flex-col gap-y-1 text-xs">
                                <span class="flex gap-x-2 items-center">
                                    <span class="line-through">232,000</span>
                                    <div class="h-7 w-7 rounded-lg bg-red-600 text-white flex-center text-xs">
                                        2%</div>
                                </span>
                                <span class="text-red-500 font-bold">212,000</span>
                                <span class="text-red-500 font-bold">تومان</span>
                            </span>
    
                            <div class="flex flex-col items-center gax-y-2">
                                <button
                                    class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <button
                                    class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                                    <i class="fa-solid fa-cart-circle-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
                        <img class="w-32" src="../images/product-1.jfif" alt="">
                        <div class="flex justify-between items-center">
                            <span class="flex flex-col gap-y-1 text-xs">
                                <span class="flex gap-x-2 items-center">
                                    <span class="line-through">232,000</span>
                                    <div class="h-7 w-7 rounded-lg bg-red-600 text-white flex-center text-xs">
                                        2%</div>
                                </span>
                                <span class="text-red-500 font-bold">212,000</span>
                                <span class="text-red-500 font-bold">تومان</span>
                            </span>
    
                            <div class="flex flex-col items-center gax-y-2">
                                <button
                                    class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <button
                                    class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                                    <i class="fa-solid fa-cart-circle-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
                        <img class="w-32" src="../images/product-1.jfif" alt="">
                        <div class="flex justify-between items-center">
                            <span class="flex flex-col gap-y-1 text-xs">
                                <span class="flex gap-x-2 items-center">
                                    <span class="line-through">232,000</span>
                                    <div class="h-7 w-7 rounded-lg bg-red-600 text-white flex-center text-xs">
                                        2%</div>
                                </span>
                                <span class="text-red-500 font-bold">212,000</span>
                                <span class="text-red-500 font-bold">تومان</span>
                            </span>
    
                            <div class="flex flex-col items-center gax-y-2">
                                <button
                                    class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <button
                                    class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                                    <i class="fa-solid fa-cart-circle-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
    
    
    
                </div>
            </section>
            <!-- recommended products ends -->


@endsection

@section('scripts')
    <script src="{{ asset('app-assets/js/cart-page.js') }}"></script>
@endsection
