@extends('app.layouts.master')

@section('content')
   
        <!-- breadcrumb starts-->
        <section
            class="px-2 py-4 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white flex flex-wrap items-center gap-1 md:gap-2">

            <a href="" class="text-xs xs:text-sm md:text-base text-red-500">خانه</a>
            <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
            <span href="" class="text-xs xs:text-sm md:text-base text-red-500">پروفایل</span>
            <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
            <span href="" class="text-xs xs:text-sm md:text-base text-red-500">لیست علاقه مندی ها</span>


        </section>
        <!-- breadcrumb ends -->

        <!-- favorites starts -->
        <section class="grid grid-cols-9 gap-4 mt-4">

            <div id="profile-section"
                class="hidden lg:block col-span-9 lg:col-span-2 flex flex-col gap-2 h-fit p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">
                <span class="flex items-center gap-2 text-xs xs:text-base">

                    <span class="text-gray-500 dark:text-gray-400">
                        پروفایل
                    </span>
                </span>

                <ul class="flex flex-col gap-4 xs:gap-y-4 py-3 mx-2 mt-2">
                    <li>
                        <button class="flex items-center gap-3 py-2">
                            <i class="fa-light fa-user text-sm xs:text-2xl"></i>
                            <span class="text-xs xs:text-base">
                                مشخصات کاربری
                            </span>
                        </button>
                    </li>
                    <li>
                        <button class="flex items-center gap-3 py-2">
                            <i class="fa-light fa-list-alt text-sm xs:text-2xl"></i>
                            <span class="text-xs xs:text-base">
                                لیست سفارشات
                            </span>
                        </button>
                    </li>
                    <li>
                        <button onclick="profileBack()"
                         class="flex items-center gap-3 py-2 text-red-500">
                            <i class="fa-light fa-heart text-sm xs:text-2xl"></i>
                            <span class="text-xs xs:text-base">
                                لیست علاقه مندی ها
                            </span>
                        </button>
                    </li>
                    <li>
                        <button class="flex items-center gap-3 py-2">
                            <i class="fa-light fa-map-location text-sm xs:text-2xl"></i>
                            <span class="text-xs xs:text-base">
                                آدرس های شما
                            </span>
                        </button>
                    </li>
                    <li>
                        <button class="flex items-center gap-3 py-2">
                            <i class="fa-light fa-right-from-bracket text-sm xs:text-2xl"></i>
                            <span class="text-xs xs:text-base">
                                خروج از حساب کاربری
                            </span>
                        </button>
                    </li>
                </ul>

            </div>
            <div id="favorites-section"
                class="lg:block col-span-9 lg:col-span-7 lg:h-fit flex flex-col gap-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">
                <span class="flex items-center gap-3">
                    <button onclick="profileBack()" class="lg:hidden text-lg">
                        <i class="fa fa-arrow-right"></i>
                    </button>
                    <span class="text-sm xs:text-base text-gray-500 dark:text-gray-400">
                        لیست علاقه مندی ها
                    </span>
                </span>

                <!-- favorites products starts -->

                <section class="grid grid-cols-8 gap-2 mt-4">

                    <div class="col-span-8 xs:col-span-4 md:col-span-2 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
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
                    <div class="col-span-8 xs:col-span-4 md:col-span-2 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
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
                    <div class="col-span-8 xs:col-span-4 md:col-span-2 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
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
                    <div class="col-span-8 xs:col-span-4 md:col-span-2 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
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
                    <div class="col-span-8 xs:col-span-4 md:col-span-2 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
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
                    <div class="col-span-8 xs:col-span-4 md:col-span-2 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
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
                    <div class="col-span-8 xs:col-span-4 md:col-span-2 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
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


                </section>
                <!-- favorites products ends -->

            </div>

        </section>
        <!-- favorites ends -->

@endsection


@section('scripts')
    <script src="{{ asset('app-assets/js/favorites-page.js') }}"></script>
@endsection
