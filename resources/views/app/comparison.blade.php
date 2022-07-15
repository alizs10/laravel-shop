@extends('app.layouts.master')

@section('content')
    <!-- comparison starts -->

    <section class="grid grid-cols-2 gap-2">

        <section class="col-span-1 relative flex flex-col gap-y-2 border-l-2 border-gray-200 dark:border-gray-700">
            <a href="" class="mx-4 md:mx-auto text-center">
                <img src="../images/product-2.webp" class="rounded-lg w-full md:w-48" alt="">
            </a>
            <span class="text-xxs xs:text-xs text-center md:text-sm mx-4 leading-5 xs:leading-6">
                گوشی موبایل اپل مدل iPhone 13 Pro Max A2644 دو سیم‌ کارت ظرفیت 256 گیگابایت و رم 6 گیگابایت
            </span>
            <span class="text-xxs xs:text-xs text-center md:text-sm mx-4 text-red-500">
                ۴۳,۴۵۰,۱۰۰ تومان
            </span>
            <a href=""
                class="absolute flex-center -top-2 xs:-top-3 left-1 w-5 h-5 xs:w-7 xs:h-7 rounded-full bg-gray-200 dark:bg-gray-500">
                <i class="fa-solid fa-xmark text-xs xs:text-base text-gray-500 dark:text-gray-800"></i>
            </a>
        </section>
        <!-- <section class="col-span-1 flex flex-col gap-y-2">
                    <a href="" class="mx-4 md:mx-auto text-center">
                        <img src="../images/product-1.jfif" class="rounded-lg w-full md:w-48" alt="">
                    </a>
                    <span class="text-xxs xs:text-xs text-center md:text-sm mx-4">
                        گوشی موبایل اپل مدل iPhone 13 Pro Max A2644 دو سیم‌ کارت ظرفیت 256 گیگابایت و رم 6 گیگابایت
                    </span>

                </section> -->

        <section class="col-span-1 flex-center">
            <button onclick="compareProductsToggle()"
                class="text-xxs xs:text-xs px-3 py-2 bg-red-500 rounded-lg text-white">
                انتخاب کالا
            </button>

        </section>

        <section class="col-span-2 mx-2 mt-4 flex flex-col gap-y-2">
            <span class="text-xxs xs:text-xs mt-2 md:mt-8 text-gray-500 dark:text-gray-400 text-center">
                وزن
            </span>

            <div class="grid grid-cols-2 gap-2">
                <span class="text-xxs xs:text-xs border-l-2 border-gray-200 dark:border-gray-700 text-center">
                    ۲۴۰ گرم
                </span>
                <!-- <span class="text-xxs xs:text-xs text-center">
                            ۱۷۹ گرم
                        </span> -->
            </div>
            <span class="text-xxs xs:text-xs mt-2 md:mt-8 text-gray-500 dark:text-gray-400 text-center">
                پردازنده‌ی مرکزی
            </span>

            <div class="grid grid-cols-2 gap-2">
                <span class="text-xxs xs:text-xs border-l-2 border-gray-200 dark:border-gray-700 text-center">
                    Hexa-core CPU
                </span>
                <!-- <span class="text-xxs xs:text-xs text-center">
                            ۴x Kryo ۲۶۵ Gold &amp; ۴x Kryo ۲۶۵ Silver
                        </span> -->
            </div>
            <span class="text-xxs xs:text-xs mt-2 md:mt-8 text-gray-500 dark:text-gray-400 text-center">
                فرکانس پردازنده‌ی مرکزی
            </span>

            <div class="grid grid-cols-2 gap-2">
                <span class="text-xxs xs:text-xs border-l-2 border-gray-200 dark:border-gray-700 text-center">
                    -
                </span>
                <!-- <span class="text-xxs xs:text-xs text-center">
                            ۲.۴ - ۱.۹ گیگاهرتز
                        </span> -->
            </div>
            <span class="text-xxs xs:text-xs mt-2 md:mt-8 text-gray-500 dark:text-gray-400 text-center">
                اندازه
            </span>

            <div class="grid grid-cols-2 gap-2">
                <span class="text-xxs xs:text-xs border-l-2 border-gray-200 dark:border-gray-700 text-center">
                    ۶.۷ اینچ
                </span>
                <!-- <span class="text-xxs xs:text-xs text-center">
                            ۶.۴۳ اینچ
                        </span> -->
            </div>
            <span class="text-xxs xs:text-xs mt-2 md:mt-8 text-gray-500 dark:text-gray-400 text-center">
                نسخه بلوتوث
            </span>

            <div class="grid grid-cols-2 gap-2">
                <span class="text-xxs xs:text-xs border-l-2 border-gray-200 dark:border-gray-700 text-center">
                    ۵.۰
                </span>
                <!-- <span class="text-xxs xs:text-xs text-center">
                            ۵.۰
                        </span> -->
            </div>
            <span class="text-xxs xs:text-xs mt-2 md:mt-8 text-gray-500 dark:text-gray-400 text-center">
                سیستم عامل
            </span>

            <div class="grid grid-cols-2 gap-2">
                <span class="text-xxs xs:text-xs border-l-2 border-gray-200 dark:border-gray-700 text-center">
                    iOS
                </span>
                <!-- <span class="text-xxs xs:text-xs text-center">
                            Android
                        </span> -->
            </div>
        </section>

    </section>


    <!-- comparison ends -->
@endsection

@section('add-to-body')
    <!-- products to compare modal starts -->
    <div id="compare-products-backdrop" onclick="compareProductsToggle()"
        class="hidden fixed top-0 bottom-0 left-0 right-0 bg-gray-500/70 z-40 transition-all duration-300">

        <div class="w-full h-full lg:w-3/5 lg:h-2/3 lg:rounded-lg bg-gray-100 dark:bg-gray-800"
            onclick="event.stopPropagation()">
            <div class="flex items-center justify-between h-16 px-3 border-b-2 border-gray-200 dark:border-gray-700">
                <span class="text-xs">انتخاب کالا برای مقایسه</span>
                <button onclick="compareProductsToggle()"
                    class="text-xl w-10 h-10 rounded-full hover-transition hover:bg-gray-200 dark:hover:bg-gray-700">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-2 h-[calc(100%_-_4.5rem)] overflow-y-scroll">
                <section class="col-span-1 flex flex-col gap-y-2">
                    <a href="" class="mx-4 md:mx-auto text-center">
                        <img src="../images/product-2.webp" class="rounded-lg w-full md:w-48" alt="">
                    </a>
                    <span class="text-xxs xs:text-xs text-center md:text-sm mx-4">
                        گوشی موبایل اپل مدل iPhone 13 Pro Max A2644 دو سیم‌ کارت ظرفیت 256 گیگابایت و رم 6 گیگابایت
                    </span>
                    <span class="text-xxs xs:text-xs text-center md:text-sm mx-4 text-red-500">
                        ۴۳,۴۵۰,۱۰۰ تومان
                    </span>

                </section>
                <section class="col-span-1 flex flex-col gap-y-2">
                    <a href="" class="mx-4 md:mx-auto text-center">
                        <img src="../images/product-2.webp" class="rounded-lg w-full md:w-48" alt="">
                    </a>
                    <span class="text-xxs xs:text-xs text-center md:text-sm mx-4">
                        گوشی موبایل اپل مدل iPhone 13 Pro Max A2644 دو سیم‌ کارت ظرفیت 256 گیگابایت و رم 6 گیگابایت
                    </span>
                    <span class="text-xxs xs:text-xs text-center md:text-sm mx-4 text-red-500">
                        ۴۳,۴۵۰,۱۰۰ تومان
                    </span>

                </section>
                <section class="col-span-1 flex flex-col gap-y-2">
                    <a href="" class="mx-4 md:mx-auto text-center">
                        <img src="../images/product-2.webp" class="rounded-lg w-full md:w-48" alt="">
                    </a>
                    <span class="text-xxs xs:text-xs text-center md:text-sm mx-4">
                        گوشی موبایل اپل مدل iPhone 13 Pro Max A2644 دو سیم‌ کارت ظرفیت 256 گیگابایت و رم 6 گیگابایت
                    </span>
                    <span class="text-xxs xs:text-xs text-center md:text-sm mx-4 text-red-500">
                        ۴۳,۴۵۰,۱۰۰ تومان
                    </span>

                </section>
                <section class="col-span-1 flex flex-col gap-y-2">
                    <a href="" class="mx-4 md:mx-auto text-center">
                        <img src="../images/product-2.webp" class="rounded-lg w-full md:w-48" alt="">
                    </a>
                    <span class="text-xxs xs:text-xs text-center md:text-sm mx-4">
                        گوشی موبایل اپل مدل iPhone 13 Pro Max A2644 دو سیم‌ کارت ظرفیت 256 گیگابایت و رم 6 گیگابایت
                    </span>
                    <span class="text-xxs xs:text-xs text-center md:text-sm mx-4 text-red-500">
                        ۴۳,۴۵۰,۱۰۰ تومان
                    </span>

                </section>
                <section class="col-span-1 flex flex-col gap-y-2">
                    <a href="" class="mx-4 md:mx-auto text-center">
                        <img src="../images/product-2.webp" class="rounded-lg w-full md:w-48" alt="">
                    </a>
                    <span class="text-xxs xs:text-xs text-center md:text-sm mx-4">
                        گوشی موبایل اپل مدل iPhone 13 Pro Max A2644 دو سیم‌ کارت ظرفیت 256 گیگابایت و رم 6 گیگابایت
                    </span>
                    <span class="text-xxs xs:text-xs text-center md:text-sm mx-4 text-red-500">
                        ۴۳,۴۵۰,۱۰۰ تومان
                    </span>

                </section>

            </div>


        </div>

    </div>
    <!-- products to compare modal ends -->
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('app-assets/js/comparison-page.js') }}"></script>
@endsection