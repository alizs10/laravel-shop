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


        </section>
        <!-- breadcrumb ends -->

        <!-- orders starts -->
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
                        <a href="{{ route('app.user.profile') }}" class="flex items-center gap-3 py-2">
                            <i class="fa-light fa-user text-sm xs:text-2xl"></i>
                            <span class="text-xs xs:text-base">
                                مشخصات کاربری
                            </span>
                        </a>
                    </li>
                    <li>
                        <button onclick="profileBack()" class="flex items-center gap-3 py-2 text-red-500">
                            <i class="fa-light fa-list-alt text-sm xs:text-2xl"></i>
                            <span class="text-xs xs:text-base">
                                لیست سفارشات
                            </span>
                        </button>
                    </li>
                    <li>
                        <a href="{{ route('app.user.favorites') }}" class="flex items-center gap-3 py-2">
                            <i class="fa-light fa-heart text-sm xs:text-2xl"></i>
                            <span class="text-xs xs:text-base">
                                لیست علاقه مندی ها
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('app.user.addresses') }}" class="flex items-center gap-3 py-2">
                            <i class="fa-light fa-map-location text-sm xs:text-2xl"></i>
                            <span class="text-xs xs:text-base">
                                آدرس های شما
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('auth.logout') }}" class="flex items-center gap-3 py-2">
                            <i class="fa-light fa-right-from-bracket text-sm xs:text-2xl"></i>
                            <span class="text-xs xs:text-base">
                                خروج از حساب کاربری
                            </span>
                        </a>
                    </li>
                </ul>

            </div>
            <div id="orders-section"
                class="lg:block col-span-9 lg:col-span-7 lg:h-fit flex flex-col gap-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">
                <span class="flex items-center gap-3">
                    <button onclick="profileBack()" class="lg:hidden text-lg">
                        <i class="fa fa-arrow-right"></i>
                    </button>
                    <span class="text-sm xs:text-base text-gray-500 dark:text-gray-400">
                        لیست سفارشات
                    </span>
                </span>

                <div class="grid grid-cols-3 xs:grid-cols-5 mt-2 bg-white dark:bg-gray-700 rounded-lg overflow-hidden">
                    <div
                        class="col-span-1 px-3 py-2 flex-center gap-2 text-sm cursor-pointer hover-transition hover:bg-gray-200 hover:dark:bg-gray-900">
                        <span class="text-lg lg:text-xl xs:text-3xl">
                            <i class="fa-light fa-clock"></i>
                        </span>
                        <span class="hidden lg:block">در انتظار پرداخت</span>
                        <span class="w-6 h-6 bg-red-500 flex-center text-white text-xs rounded-lg">۱</span>
                    </div>
                    <div
                        class="col-span-1 px-3 py-2 flex-center gap-2 text-sm cursor-pointer hover-transition hover:bg-gray-200 hover:dark:bg-gray-900">
                        <span class="text-lg lg:text-xl xs:text-3xl text-blue-600 dark:text-blue-500">
                            <i class="fa-light fa-loader"></i>
                        </span>
                        <span class="hidden lg:block">در حال پردازش</span>
                       
                    </div>
                    <div
                        class="col-span-1 px-3 py-2 flex-center gap-2 text-sm cursor-pointer hover-transition hover:bg-gray-200 hover:dark:bg-gray-900">
                        <span class="text-lg lg:text-xl xs:text-3xl text-emerald-600">
                            <i class="fa-light fa-hexagon-check"></i>
                        </span>
                        <span class="hidden lg:block">پرداخت شده</span>
                        <span class="w-6 h-6 bg-red-500 flex-center text-white text-xs rounded-lg">۲</span>
                    </div>
                    
                    <div
                        class="col-span-1 px-3 py-2 flex-center gap-2 text-sm cursor-pointer hover-transition hover:bg-gray-200 hover:dark:bg-gray-900">
                        <span class="text-lg lg:text-xl xs:text-3xl text-red-500">
                            <i class="fa-light fa-hexagon-xmark"></i>
                        </span>
                        <span class="hidden lg:block">لغو شده</span>
           
                    </div>
                    <div
                        class="col-span-1 px-3 py-2 flex-center gap-2 text-sm cursor-pointer hover-transition hover:bg-gray-200 hover:dark:bg-gray-900">
                        <span class="text-lg lg:text-xl xs:text-3xl text-orange-500">
                            <i class="fa-light fa-arrow-rotate-left"></i>
                        </span>
                        <span class="hidden lg:block">مرجوعی</span>
                        
                    </div>
                </div>

                <!-- orders list starts -->
                <div class="flex flex-col gap-2 mt-2">
                    <div class="flex flex-col gap-2 rounded-lg bg-white dark:bg-gray-700 shadow-md p-3">
                        <span class="flex justify-between pb-2 border-b-2 boder-gray-100 dark:border-gray-600">
                            <span class="flex gap-2 text-xxxs xs:text-xs text-gray-500 dark:text-gray-400">
                                <span>۲۳ فروردین ۱۳۴۰۱</span>
                                <span class="flex-center text-xxxs">
                                    <i class="fa-solid fa-circle"></i>
                                </span>
                                <span>LSC-4578965</span>
                                <span class="flex-center text-xxxs">
                                    <i class="fa-solid fa-circle"></i>
                                </span>
                                <span class="text-blue-600 dark:text-blue-500">در حال پردازش</span>
                            </span>
                        </span>

                        <div class="grid grid-cols-6 xs:grid-cols-10 gap-2 pb-2 border-b-2 boder-gray-100 dark:border-gray-600">
                            <div class="col-span-2 lg:col-span-1 rounded-lg overflow-hidden">
                                <img src="../images/product-2.webp" alt="">
                            </div>
                            <div class="col-span-2 lg:col-span-1 rounded-lg overflow-hidden">
                                <img src="../images/product-2.webp" alt="">
                            </div>
                            <div class="col-span-2 lg:col-span-1 rounded-lg overflow-hidden">
                                <img src="../images/product-2.webp" alt="">
                            </div>
                            <div class="col-span-2 lg:col-span-1 rounded-lg overflow-hidden">
                                <img src="../images/product-2.webp" alt="">
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs xs:text-sm">۲۳۲,۰۰۰ تومان</span>

                            <div class="flex gap-2">
                                <a class="px-3 py-2 xs:px-4 xs:py-3 text-xs rounded-lg text-white bg-gray-500" href="">فاکتور</a>
                                <a class="px-3 py-2 xs:px-4 xs:py-3 text-xs rounded-lg text-white bg-emerald-600" href="">جزییات</a>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 rounded-lg bg-white dark:bg-gray-700 shadow-md p-3">
                        <span class="flex justify-between pb-2 border-b-2 boder-gray-100 dark:border-gray-600">
                            <span class="flex gap-2 text-xxxs xs:text-xs text-gray-500 dark:text-gray-400">
                                <span>۲۳ فروردین ۱۳۴۰۱</span>
                                <span class="flex-center text-xxxs">
                                    <i class="fa-solid fa-circle"></i>
                                </span>
                                <span>LSC-4578965</span>
                                <span class="flex-center text-xxxs">
                                    <i class="fa-solid fa-circle"></i>
                                </span>
                                <span class="text-blue-600 dark:text-blue-500">در حال پردازش</span>
                            </span>
                        </span>

                        <div class="grid grid-cols-6 xs:grid-cols-10 gap-2 pb-2 border-b-2 boder-gray-100 dark:border-gray-600">
                            <div class="col-span-2 lg:col-span-1 rounded-lg overflow-hidden">
                                <img src="../images/product-2.webp" alt="">
                            </div>
                            <div class="col-span-2 lg:col-span-1 rounded-lg overflow-hidden">
                                <img src="../images/product-2.webp" alt="">
                            </div>
                            <div class="col-span-2 lg:col-span-1 rounded-lg overflow-hidden">
                                <img src="../images/product-2.webp" alt="">
                            </div>
                            <div class="col-span-2 lg:col-span-1 rounded-lg overflow-hidden">
                                <img src="../images/product-2.webp" alt="">
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs xs:text-sm">۲۳۲,۰۰۰ تومان</span>

                            <div class="flex gap-2">
                                <a class="px-3 py-2 xs:px-4 xs:py-3 text-xs rounded-lg text-white bg-gray-500" href="">فاکتور</a>
                                <a class="px-3 py-2 xs:px-4 xs:py-3 text-xs rounded-lg text-white bg-emerald-600" href="">جزییات</a>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 rounded-lg bg-white dark:bg-gray-700 shadow-md p-3">
                        <span class="flex justify-between pb-2 border-b-2 boder-gray-100 dark:border-gray-600">
                            <span class="flex gap-2 text-xxxs xs:text-xs text-gray-500 dark:text-gray-400">
                                <span>۲۳ فروردین ۱۳۴۰۱</span>
                                <span class="flex-center text-xxxs">
                                    <i class="fa-solid fa-circle"></i>
                                </span>
                                <span>LSC-4578965</span>
                                <span class="flex-center text-xxxs">
                                    <i class="fa-solid fa-circle"></i>
                                </span>
                                <span class="text-blue-600 dark:text-blue-500">در حال پردازش</span>
                            </span>
                        </span>

                        <div class="grid grid-cols-6 xs:grid-cols-10 gap-2 pb-2 border-b-2 boder-gray-100 dark:border-gray-600">
                            <div class="col-span-2 lg:col-span-1 rounded-lg overflow-hidden">
                                <img src="../images/product-2.webp" alt="">
                            </div>
                            <div class="col-span-2 lg:col-span-1 rounded-lg overflow-hidden">
                                <img src="../images/product-2.webp" alt="">
                            </div>
                            <div class="col-span-2 lg:col-span-1 rounded-lg overflow-hidden">
                                <img src="../images/product-2.webp" alt="">
                            </div>
                            <div class="col-span-2 lg:col-span-1 rounded-lg overflow-hidden">
                                <img src="../images/product-2.webp" alt="">
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs xs:text-sm">۲۳۲,۰۰۰ تومان</span>

                            <div class="flex gap-2">
                                <a class="px-3 py-2 xs:px-4 xs:py-3 text-xs rounded-lg text-white bg-gray-500" href="">فاکتور</a>
                                <a class="px-3 py-2 xs:px-4 xs:py-3 text-xs rounded-lg text-white bg-emerald-600" href="">جزییات</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- orders list ends -->

            </div>

        </section>
        <!-- orders ends -->

@endsection


@section('scripts')
    <script src="{{ asset('app-assets/js/orders-page.js') }}"></script>
@endsection
