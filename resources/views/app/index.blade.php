@extends('app.layouts.master')

@section('content')
       <!-- amazing sales starts -->
       <section class="flex flex-col gap-y-2 p-2 rounded-lg mt-4 bg-red-500 text-white">
        <div class="flex justify-between items-center text-base">
            <span>تخفیف های شگفت انگیز</span>
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
    <!-- amazing sales ends -->


    <!-- add starts -->
    <section
        class="rounded-lg my-4 h-24 text-2xl flex-center p-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
        <span class="">محل تبلیغات شما</span>
    </section>
    <!-- add ends -->


    <!-- recommended products starts -->
    <section class="flex flex-col gap-y-2 p-2 rounded-lg mt-4 bg-gray-300 dark:bg-gray-700 text-white">
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

    <!-- add starts -->
    <section
        class="rounded-lg my-4 h-24 text-2xl flex-center p-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
        <span class="">محل تبلیغات شما</span>
    </section>
    <!-- add ends -->

    <!-- visited products starts -->
    <section class="flex flex-col gap-y-2 p-2 rounded-lg mt-4 bg-gray-300 dark:bg-gray-700 text-white">
        <div class="flex justify-between items-center text-black dark:text-white text-base">
            <span>بازدید های اخیر شما</span>
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
    <!-- visited products ends -->

    <!-- add starts -->
    <section
        class="rounded-lg my-4 h-24 text-2xl flex-center p-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
        <span class="">محل تبلیغات شما</span>
    </section>
    <!-- add ends -->
@endsection