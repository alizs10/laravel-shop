@extends('app.layouts.master')

@section('content')
    <!-- breadcrumb starts-->
    <section
        class="px-2 py-4 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white flex flex-wrap items-center gap-1 md:gap-2">

        <a href="" class="text-xs md:text-base text-red-500">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs md:text-base">محصولات</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs md:text-base">{{ $page }}</span>

    </section>
    <!-- breadcrumb ends -->

    <!-- products starts -->
    <section
        class="mt-4 p-3 grid grid-cols-1 xs:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-2 rounded-lg bg-gray-100 dark:bg-gray-800">

        <div class="col-span-1 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
            <a href="">
                <img class="w-full" src="../images/product-2.webp" alt="">
            </a>
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
                    <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                    <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                        <i class="fa-solid fa-cart-circle-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-span-1 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
            <a href="">
                <img class="w-full" src="../images/product-2.webp" alt="">
            </a>
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
                    <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                    <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                        <i class="fa-solid fa-cart-circle-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-span-1 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
            <a href="">
                <img class="w-full" src="../images/product-2.webp" alt="">
            </a>
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
                    <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                    <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                        <i class="fa-solid fa-cart-circle-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-span-1 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
            <a href="">
                <img class="w-full" src="../images/product-2.webp" alt="">
            </a>
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
                    <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                    <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                        <i class="fa-solid fa-cart-circle-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-span-1 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
            <a href="">
                <img class="w-full" src="../images/product-2.webp" alt="">
            </a>
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
                    <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                    <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                        <i class="fa-solid fa-cart-circle-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-span-1 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
            <a href="">
                <img class="w-full" src="../images/product-2.webp" alt="">
            </a>
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
                    <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                    <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                        <i class="fa-solid fa-cart-circle-plus"></i>
                    </button>
                </div>
            </div>
        </div>

    </section>
    <!-- products ends -->
@endsection
