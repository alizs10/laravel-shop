@extends('app.layouts.master')

@section('content')
    <!-- breadcrumb starts-->
    <section
        class="px-2 py-4 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white flex flex-wrap items-center gap-1 md:gap-2">

        <a href="" class="text-xs md:text-base text-red-500">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs md:text-base">جستوجو در محصولات</span>



    </section>
    <!-- breadcrumb ends -->


    <!-- search starts -->
    <section class="mt-4 grid grid-cols-9 gap-2">

        <!-- filters starts -->
        <section id="filters"
            class="hidden lg:block fixed lg:static lg:col-span-2 top-0 right-0 bottom-0 lg:bottom-auto lg:pb-4 left-0 z-30 lg:z-0 bg-white lg:rounded-lg dark:bg-gray-900 lg:bg-gray-100 lg:dark:bg-gray-800 transition-all duration-300 lg:h-fit lg:shadow-lg">

            <div class="flex flex-col gap-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm mt-4 mr-4">اعمال فیلتر</span>
                    <button class="ml-4 mt-4 text-xl lg:hidden" onclick="toggleFilters()">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div id="category-filter" class="py-2 px-4">
                    <span onclick="toggleCategoryFilter()" class="flex justify-between items-center cursor-pointer">
                        <span>فیلتر دسته بندی</span>
                        <i class="fa fa-angle-left"></i>
                    </span>
                    <div
                        class="hidden fixed lg:static top-0 right-0 bottom-0 left-0 bg-white dark:bg-gray-900 lg:bg-transparent lg:dark:bg-transparent z-10 flex flex-col gap-4">
                        <div class="flex justify-between items-center lg:hidden">
                            <span class="text-sm mt-4 mr-4">فیلتر دسته بندی</span>
                            <button class="ml-4 mt-4 text-xl" onclick="toggleCategoryFilter()">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>

                        <div class="flex flex-col gap-4 mx-4 lg:mt-4">
                            <span id="cat-filter-0" onclick="toggleSubCategoryFilter(0)"
                                class="flex items-center cursor-pointer gap-2">
                                <i class="fa fa-angle-left text-sm"></i>
                                <span class="text-xs">کالاهای دیجیتال</span>
                            </span>
                            <span id="cat-filter-1" data-parent-id="0" onclick="toggleSubCategoryFilter(1)"
                                class="hidden flex items-center cursor-pointer gap-2 mr-4">
                                <i class="fa fa-angle-left text-sm"></i>
                                <span class="text-xs">گوشی موبایل</span>
                            </span>
                            <span data-parent-id="1" onclick=""
                                class="hidden flex items-center cursor-pointer gap-2 mr-8">
                                <span class="text-xs">گوشی های سامسونگ</span>
                            </span>
                            <span data-parent-id="1" onclick=""
                                class="hidden flex items-center cursor-pointer gap-2 mr-8">
                                <span class="text-xs">گوشی های شیایومی</span>
                            </span>
                            <span data-parent-id="1" onclick=""
                                class="hidden flex items-center cursor-pointer gap-2 mr-8">
                                <span class="text-xs">گوشی های اپل</span>
                            </span>
                        </div>

                    </div>
                </div>
                <div id="price-filter" class="py-2 px-4">
                    <span onclick="togglePriceFilter()" class="flex justify-between items-center cursor-pointer">
                        <span>فیلتر قیمت</span>
                        <i class="fa fa-angle-left"></i>
                    </span>
                    <div
                        class="hidden fixed lg:static top-0 right-0 bottom-0 left-0 bg-white dark:bg-gray-900 lg:bg-transparent lg:dark:bg-transparent z-10 flex flex-col gap-4">
                        <div class="flex justify-between items-center lg:hidden">
                            <span class="text-sm mt-4 mr-4">فیلتر قیمت</span>
                            <button class="ml-4 mt-4 text-xl" onclick="togglePriceFilter()">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>

                        <div class="flex flex-col gap-4 mx-4 lg:mx-0 lg:mt-4">
                            <div class="flex flex-col gap-2">
                                <label for="">از قیمت</label>
                                <input class="form-input dark:border-gray-700" type="text" name="start-price"
                                    value="0" min="0">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="">تا قیمت</label>
                                <input class="form-input dark:border-gray-700" type="text" name="end-price"
                                    value="100000000" max="100000000">
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 mx-4 lg:mx-0">
                            <span class="text-sm">
                                محدوده قیمت
                            </span>

                            <div id="price-filter-rect"
                                class="rounded-lg bg-gray-200 dark:bg-gray-700 h-5 relative touch-none">
                                <div id="price-filter-range"
                                    class="absolute top-0 right-0 left-0 bg-red-500 h-5 flex justify-between rounded-full">
                                    <span id="price-filter-start-btn"
                                        class="rounded-full w-5 h-5 bg-white cursor-pointer"></span>
                                    <span id="price-filter-end-btn"
                                        class="rounded-full w-5 h-5 bg-white cursor-pointer"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-2 px-4">
                    <span class="flex justify-between items-center">
                        <span>فقط کالاهای مجود</span>

                        <span class="flex items-center @if($filters && $filters['exists'] === true) justify-end bg-red-500 @else bg-gray-200 dark:bg-gray-700 @endif rounded-lg p-1 w-12">

                            <span onclick="toggleProductsExistFilter(this)"
                                class="w-5 h-5 rounded-full bg-white cursor-pointer"></span>
                            <input type="hidden" name="exists" @if($filters && $filters['exists'] === true) value="true" @else value="false" @endif />
                        </span>
                    </span>
                </div>

            </div>

            <button onclick="applySearchFilter()"
                class="fixed lg:static lg:mx-2 lg:rounded-lg lg:mt-2 text-sm xs:text-base bottom-0 right-0 left-0 block text-center py-2 xs:py-3 bg-red-500 text-white">اعمال
                فیلتر</button>

        </section>

        <!-- filters ends -->



        <section class="col-span-9 lg:col-span-7 flex flex-col gap-3 rounded-lg bg-gray-100 dark:bg-gray-800 shadow-lg p-3">
            <div class="flex flex-col gap-2 pb-2 border-b border-white">
                <span class="flex justify-between items-center text-xxs xs:text-xs">
                    <span>نتایج جستجو برای "<span id="searched-word">{{ $search }}</span>"</span>
                    <span class="text-red-500">{{ e2p_numbers($results->count()) }} مورد</span>
                </span>
                @if (!empty($filters))
                    <span class="flex flex-col gap-2 text-xxs xs:text-xs">
                        <span class="flex justify-between items-center text-xs xs:text-sm">
                            <span>فیلتر ها:</span>
                            <button onclick="toggleFilters()"
                                class="lg:hidden w-10 h-10 text-gray-700 dark:text-gray-200 rounded-lg text-xl hover-transition hover:bg-gray-200 dark:hover:bg-gray-700">
                                <i class="fa-regular fa-filter"></i>
                            </button>
                        </span>
                        <span class="flex flex-wrap gap-2">
                            @if ($filters['price'])
                                <span class="rounded-lg p-2 bg-red-500 text-white">قیمت</span>
                            @endif
                            @if ($filters['cat'])
                                <span class="rounded-lg p-2 bg-red-500 text-white">دسته بندی</span>
                            @endif
                            @if ($filters['exists'])
                                <span class="rounded-lg p-2 bg-red-500 text-white">فقط کالاهای موجود</span>
                            @endif

                        </span>
                    </span>
                @endif
            </div>

            <!-- search results starts -->

            <section class="grid grid-cols-8 gap-2">

                @foreach ($results as $result)
                    <div
                        class="col-span-8 xs:col-span-4 md:col-span-2 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
                        <a href="{{ route('app.product.index', $result->id) }}">
                            <img class="w-full" src="{{ asset('storage\\' . $result->image['indexArray']['medium']) }}"
                                alt="">
                        </a>
                        <div class="flex justify-between items-center">

                            @if (!is_null($result->amazingSale))
                                <span class="flex flex-col gap-y-1 text-xs">
                                    <span class="flex gap-x-2 items-center">
                                        <span class="line-through">{{ $result->price }}</span>
                                        <div class="h-7 w-7 rounded-lg bg-red-600 text-white flex-center text-xs">
                                            {{ $result->amazingSale->percentage }}%</div>
                                    </span>
                                    <span class="text-red-500 font-bold">{{ $result->amazingSale->price }}</span>
                                    <span class="text-red-500 font-bold">تومان</span>
                                </span>
                            @else
                                <span class="flex flex-col gap-y-1 text-xs">
                                    <span>{{ $result->price }}</span>
                                    <span class="font-bold">تومان</span>
                                </span>
                            @endif

                            <div class="flex flex-col items-center gax-y-2">
                                <button onclick="addToFavorites(this)"
                                    class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <button onclick="addToCart(this)"
                                    data-url="{{ route('app.product.toggle-product', $result->id) }}"
                                    class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                                    @if ($cart_items->count() > 0)
                                        @php
                                            $is_item_in_cart = false;
                                            
                                            foreach ($cart_items as $cart_item) {
                                                if ($cart_item->product_id == $result->id) {
                                                    $is_item_in_cart = true;
                                                    break;
                                                }
                                            }
                                        @endphp

                                        @if ($is_item_in_cart)
                                            <i class="fa-solid fa-cart-circle-check"></i>
                                        @else
                                            <i class="fa-solid fa-cart-circle-plus"></i>
                                        @endif
                                    @else
                                        <i class="fa-solid fa-cart-circle-plus"></i>
                                    @endif
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach





            </section>
            <!-- search results ends -->
        </section>


    </section>
    <!-- search ends -->
@endsection

@section('scripts')
    <script src="{{ asset('app-assets/js/search-page.js') }}"></script>
@endsection
