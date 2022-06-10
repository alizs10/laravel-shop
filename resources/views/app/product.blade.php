@extends('app.layouts.master')

@section('content')
    <!-- breadcrumb starts-->
    <section
        class="px-2 py-4 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white flex flex-wrap items-center gap-1 md:gap-2">

        <a href="" class="text-xs md:text-base text-red-500">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs md:text-base text-red-500">محصولات</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs md:text-base text-red-500">کالاهای دیجیتال</span>


    </section>
    <!-- breadcrumb ends -->


    <!-- product starts -->

    <section class="mt-4 px-3 py-4 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white flex flex-col gap-4">

        <div class="flex flex-wrap items-center justify-between gap-4">
            <span class="text-xs xs:text-base md:text-lg text-red-500">{{ $product->name }}</span>

            <div class="flex items-center gap-x-4">
                <button class="text-2xl">
                    <i class="fa-regular fa-heart"></i>
                </button>
                <button class="text-2xl">
                    <i class="fa-regular fa-bell"></i>
                </button>
                <button class="text-2xl">
                    <i class="fa-regular fa-code-compare"></i>
                </button>
                <button class="text-2xl">
                    <i class="fa-regular fa-share-nodes"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4">

            <!-- product images slider starts -->
            <section class="col-span-12 md:col-span-4 grid grid-cols-12 gap-2">

                <section class="relative z-0 col-span-12 bg-white rounded-lg ltr overflow-hidden">

                    <div id="slidershow-imgs" class="w-full flex flex-wrap overflow-hidden">

                        @foreach ($product->gallery as $key => $galleryImage)
                            <img id="slider-{{ $key + 1 }}"
                                src="{{ asset('storage\\' . $galleryImage->image['indexArray']['larger']) }}"
                                class="w-full @if ($key == 0) active @else hidden @endif"
                                alt="{{ $product->name }}">
                        @endforeach

                    </div>

                    <div id="s-btns"
                        class="absolute bottom-2 z-0 right-0 left-0 py-3 ml-4 flex justify-start items-center gap-x-2">
                        @foreach ($product->gallery as $key => $galleryImage)
                            <span id="s-btn-{{ $key + 1 }}"
                                class="transition-all duration-300 shadow-lg @if ($key == 0) bg-red-500 @else bg-white @endif w-4 h-3 rounded-lg cursor-pointer"></span>
                        @endforeach
                    </div>
                </section>

            </section>
            <!-- product images slider ends -->

            <!-- product details starts -->
            <div class="col-span-12 md:col-span-4 flex flex-col gap-3">
                <span class="text-base">ویژگی ها</span>

                @foreach ($product->metas as $meta)
                    <span class="mt-2 flex gap-x-2 items-center text-xxs">
                        <span class="flex gap-x-1 items-start">
                            <i class="fa-regular fa-circle-small text-xs"></i>
                            {{ $meta->meta_key }}:
                        </span>

                        <span class="text-sm"> {{ $meta->meta_value }}</span>
                    </span>
                @endforeach

                <span class="mt-2 flex gap-x-2 items-center text-sm">
                    <span class="flex gap-x-1 items-center">
                        <i class="fa-regular fa-shield-check text-lg"></i>

                    </span>

                    <span>گارانتی اصالات و سلامت فیزیکی کالا</span>
                </span>
                <span class="mt-2 flex gap-x-2 items-center text-sm">
                    <span class="flex gap-x-1 items-center">
                        <i class="fa-regular fa-calendar-week text-lg"></i>

                    </span>

                    <span>ضمانت 7 روزه بازگشت کالا</span>
                </span>

                @if ($product->colors->count() > 0)
                    <span class="mt-2 flex flex-col gap-2 text-sm">
                        <span class="flex gap-x-1 items-center">
                            <i class="fa-regular fa-palette text-lg"></i>
                            انتخاب رنگ
                        </span>

                        <div class="flex flex-wrap gap-2" id="product-colors">

                            @foreach ($product->colors as $color)
                                <span class="cursor-pointer text-xs rounded-lg px-2 py-1 border-2 flex items-center gap-2"
                                    style="border-color: {{ '#' . $color->color_code }}">
                                    <div class="rounded-full h-3 w-3"
                                        style="background-color: {{ '#' . $color->color_code }}">
                                    </div>
                                    {{ $color->color_name }}
                                </span>
                            @endforeach


                        </div>
                    </span>
                @endif
                @if ($product->marketable_number > 0)
                    <span class="mt-2 flex gap-x-2 items-center text-sm font-bold text-emerald-700 dark:text-emerald-600">
                        <span class="flex gap-x-1 items-center">
                            <i class="fa-regular fa-check-double text-lg"></i>
                        </span>

                        <span>موجود در انبار</span>
                    </span>
                @else
                    <span class="mt-2 flex gap-x-2 items-center text-sm font-bold text-red-500">

                        <span class="flex gap-x-1 items-center">
                            <i class="fa-regular fa-check-double text-lg"></i>
                        </span>

                        <span>نا موجود</span>
                    </span>
                @endif
            </div>
            <!-- product details ends -->

            <!-- add to cart starts -->

            <div class="hidden md:col-span-4 md:block">
                <div class="p-4 rounded-lg overflow-hidden bg-white dark:bg-gray-900 flex flex-col gap-4">
                    <span class="flex items-start justify-between">
                        <span class="flex items-center gap-2 text-sm">
                            <i class="fa-regular fa-tag text-lg"></i>
                            قیمت محصول
                        </span>

                        <span class="flex flex-col gap-2">
                            <span class="flex gap-2">
                                <span class="line-through">{{ price_formater($product->price) }}</span>
                                @if (!empty($product->amazingSale))
                                    <span
                                        class="flex-center rounded-full h-7 w-7 bg-red-500 text-white text-xs">{{ e2p_numbers($product->amazingSale->percentage) }}٪</span>
                                @endif
                            </span>
                            @if (!empty($product->amazingSale))
                                @php
                                    $ultimate_price = $product->price - ($product->amazingSale->percentage * $product->price) / 100;
                                @endphp
                                <span>{{ price_formater($ultimate_price) }} تومان</span>
                            @else
                                <span>{{ price_formater($product->price) }} تومان</span>
                            @endif
                        </span>
                    </span>

                    @if ($product->marketable_number == 0)
                        <button class="w-full py-2 text-center rounded-lg bg-gray-500 text-white text-sm flex gap-2">
                            <i class="fa-regular fa-bell"></i>
                            موجود شد اطلاع بده!
                        </button>
                    @else
                        <button class="block py-2 text-center rounded-lg bg-red-500 text-white text-sm">
                            افزودن به سبد خرید
                        </button>
                    @endif

                </div>
            </div>

            <!-- add to cart ends -->

        </div>

    </section>
    <!-- product ends -->

    <!-- related products starts -->
    @if (count($related_products) > 0)
        <section class="flex flex-col gap-y-2 p-2 rounded-lg mt-4 bg-gray-100 dark:bg-gray-800 text-white">
            <div class="flex justify-between items-center text-black dark:text-white text-base">
                <span>محصولات مرتبط</span>
                <a href="" class="flex-center gap-x-2">
                    <span>بیشتر</span>
                    <i class="fa-duotone fa-arrow-left text-base"></i>
                </a>
            </div>

            <div class="flex flex-row gap-x-2 overflow-x-scroll no-scrollbar">

                @foreach ($related_products as $relatedProduct)
                    <a href="{{ route('app.product.index', $relatedProduct->id) }}"
                        class="flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
                        <img class="w-32"
                            src="{{ asset('storage\\' . $relatedProduct->product->image['indexArray']['medium']) }}"
                            alt="">
                        <div class="flex justify-between items-center">
                            <span class="flex flex-col gap-y-1 text-xs">
                                <span class="flex gap-x-2 items-center">
                                    <span class="line-through">{{ $relatedProduct->product->price }}</span>
                                    <div class="h-7 w-7 rounded-lg bg-red-600 text-white flex-center text-xs">
                                        {{ $relatedProduct->percentage }}%</div>
                                </span>
                                <span class="text-red-500 font-bold">{{ $relatedProduct->price }}</span>
                                <span class="text-red-500 font-bold">تومان</span>
                            </span>

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
                    </a>
                @endforeach


            </div>
        </section>
    @endif
    <!-- related products ends -->

    <!-- product introduction starts -->
    <section class="flex flex-col gap-y-2 p-2 rounded-lg mt-4 bg-gray-100 dark:bg-gray-800 dark:text-white">

        <div class="flex flex-col gap-2 mt-2 p-2">
            <span class="text-base md:text-lg text-red-500 flex flex-wrap gap-1">
                <span>معرفی</span>
            </span>

            <p class="text-justify text-xs md:text-sm leading-6 md:leading-7">
                {{ html_entity_decode(strip_tags($product->introduction)) }}
            </p>
        </div>
        <div class="flex flex-col gap-2 mt-2 p-2">
            <span class="text-base md:text-lg text-red-500 flex flex-wrap gap-1">
                <span>مشخصات</span>
            </span>

            <div class="mt-2">
                <ol class="flex flex-col rounded-lg leading-5 overflow-hidden">

                    @foreach ($product->specs as $key => $spec)
                        <li class="grid grid-cols-6 {{ $key > 3 ? 'hidden' : '' }}">
                            <span class="col-span-2 md:col-span-1 p-4 bg-gray-200 dark:bg-gray-700 text-xxs md:text-sm">
                                {{ $spec->name }}
                            </span>
                            <span class="col-span-4 md:col-span-5 p-4 bg-gray-50 dark:bg-gray-900 text-xs">
                                {{ $spec->value }}

                            </span>
                        </li>
                    @endforeach

                    <li class="flex-center p-4 bg-gray-50 dark:bg-gray-900">
                        <span id="show-full-product-details"
                            class="flex gap-x-2 cursor-pointer text-black dark:text-white  text-xs">
                            <span>مشاهده کامل مشخصات کالا</span>
                            <i class="fa-light fa-angle-down"></i>
                        </span>
                    </li>
                </ol>
            </div>

        </div>
    </section>
    <!-- product introduction ends -->

    <!-- comments starts -->
    <section class="flex flex-col gap-y-2 px-2 py-4 rounded-lg mt-4 bg-gray-100 dark:bg-gray-800 dark:text-white">
        <span class="text-base md:text-lg flex flex-wrap gap-1">
            <span>نظرات کاربران (36 نظر)</span>
        </span>

        <div class="flex flex-col gap-2">


            <div class="px-3 py-4 rounded-lg bg-white dark:bg-gray-900">
                <span class="flex items-start justify-between">
                    <span class="flex flex-col gap-2">
                        <span class="text-sm">
                            سید مهدی موسوی معین
                            <span class="rounded-lg px-3 py-1 text-white bg-red-500 text-xxs">خریدار</span>
                        </span>
                        <span class="text-xs text-gray-400">13 اسفند 1400</span>
                    </span>

                    <span class="text-sm flex items-center gap-1 text-emerald-600">

                        <span>
                            <button class="text-base">
                                <i class="fa-regular fa-thumbs-up"></i>
                            </button>
                        </span>
                        <span>
                            16
                        </span>
                    </span>
                </span>

                <p class="mt-2 text-xs md:text-base text-justify leading-5">
                    سلام این گوشی واقعا عالیه من هشت عدد برای خانواده خریدم و همه راضی بودن. از تک تکشون پرسیدم.
                </p>

                <div class="grid grid-cols-10 gap-2 items-center">
                    <span class="col-span-1 text-center text-lg md:text-2xl text-red-500">
                        <i class="fa-regular fa-reply"></i>
                    </span>
                    <div class="col-span-9 px-3 py-4 mr-8 mt-4 rounded-lg bg-gray-100 dark:bg-gray-800">
                        <span class="flex items-start justify-between">
                            <span class="flex flex-col gap-2">
                                <span class="text-sm">
                                    پاسخ ادمین
                                </span>

                            </span>

                            <span class="text-sm flex items-center gap-1 text-emerald-600">

                                <span>
                                    <button class="text-base">
                                        <i class="fa-regular fa-thumbs-up"></i>
                                    </button>
                                </span>
                                <span>
                                    2
                                </span>
                            </span>
                        </span>

                        <p class="mt-2 text-xs md:text-base text-justify leading-5">
                            تشکر از خرید شما
                        </p>
                    </div>
                </div>
            </div>
            <div class="px-3 py-4 rounded-lg bg-white dark:bg-gray-900">
                <span class="flex items-start justify-between">
                    <span class="flex flex-col gap-2">
                        <span class="text-sm">
                            داریوش نیک پندار
                        </span>
                        <span class="text-xs text-gray-400">13 اسفند 1400</span>
                    </span>

                    <span class="text-sm flex items-center gap-1 text-emerald-600">

                        <span>
                            <button class="text-base">
                                <i class="fa-regular fa-thumbs-up"></i>
                            </button>
                        </span>
                        <span>
                            112
                        </span>
                    </span>
                </span>

                <p class="mt-2 text-xs md:text-base text-justify leading-5">
                    گرونه
                    #نخریم_بگنده_ارزونش_کنن
                </p>


            </div>

        </div>

    </section>
    <!-- comments ends -->
@endsection

@section('add-to-body')
    <!-- buy product button starts -->

    <section
        class="fixed z-10 right-0 bottom-0 left-0 flex justify-between items-center shadow-lg md:hidden px-4 py-3 bg-white dark:bg-gray-900 dark:text-white">

        <span class="flex flex-col gap-y-2 text-xs xs:text-base">
            <span class="flex items-center gap-x-2">
                <span class="line-through">{{ $product->price }}</span>
                <span class="w-6 h-6 rounded-lg text-xxs bg-red-500 text-white flex-center">2%</span>
            </span>
            <span class="">43,230,000 تومان</span>
        </span>

        <button class="rounded-lg bg-red-500 text-xs xs:text-base text-white py-3 px-6">
            افزودن به سبد خرید
        </button>
    </section>

    <!-- buy product button ends -->
@endsection

@section('scripts')
    <script src="{{ asset('app-assets/js/product-images-slider.js') }}"></script>
    <script src="{{ asset('app-assets/js/product-color-selecter.js') }}"></script>
    <script src="{{ asset('app-assets/js/product-details.js') }}"></script>
@endsection
