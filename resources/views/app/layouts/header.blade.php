<header
    class="fixed lg:z-40 top-0 right-0 left-0 bg-white dark:bg-gray-800 p-2 flex flex-col gap-y-2 shadow-md lg:shadow-none">

    <section class="grid grid-cols-8 md:grid-cols-10 items-center">
        <div class="col-span-1 lg:hidden flex justify-start items-center">
            <button onclick="toggleSidebar()"
                class="w-10 h-10 dark:text-white rounded-lg text-xl hover-transition hover:bg-gray-100 dark:hover:bg-gray-800">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <span
            class="col-span-6 md:col-span-8 lg:col-span-9 text-red-500 text-2xl font-bold text-center md:text-right">لاراول</span>



        <div class="col-span-1 flex justify-end items-center">
            <button
                class="w-10 h-10 text-gray-700 dark:text-gray-200 rounded-lg text-xl hover-transition hover:bg-gray-100 dark:hover:bg-gray-700"
                onclick="toggleTheme()">
                <span class="dark:hidden">
                    <i class="fa-solid fa-sun-bright"></i>
                </span>
                <span class="hidden dark:inline">
                    <i class="fa-solid fa-moon-stars"></i>
                </span>
            </button>
        </div>
    </section>

    <section class="grid grid-cols-12 gap-2">
        <div
            class="lg:relative col-span-8 md:col-span-9 rounded-lg bg-gray-200 dark:bg-gray-700 grid grid-cols-12 gap-2 items-center">
            <span
                class="col-span-2 lg:col-span-1 text-lg text-gray-800 dark:text-gray-100 flex items-center justify-end md:justify-start mr-4">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" onclick="toggleSearchWindow()"
                class="col-span-10 lg:col-span-11 bg-transparent px-2 py-2 focus:outline-none dark:text-gray-100 placeholder:text-xs"
                placeholder="جستوجو در محصولات" readonly>

            <!-- search window starts -->

            <section id="search-window"
                class="hidden fixed lg:absolute top-0 right-0 bottom-0 lg:bottom-auto lg:pb-4 left-0 z-30 bg-white lg:rounded-lg dark:bg-gray-900 transition-all duration-300 lg:shadow-lg">

                <div class="flex flex-col gap-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm mt-4 mr-4">جستوجوی محصولات</span>
                        <button class="ml-4 mt-4 text-xl" onclick="toggleSearchWindow()">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="mx-4 rounded-lg bg-gray-200 dark:bg-gray-700 grid grid-cols-12 gap-2 items-center">
                        <span
                            class="col-span-2 lg:col-span-1 text-lg text-gray-800 dark:text-gray-100 flex items-center justify-center lg:justify-start lg:mr-4">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" id="search-input" oninput="handleSearchInp()"
                            class="col-span-10 lg:col-span-11 bg-transparent px-2 py-3 focus:outline-none dark:text-gray-100 placeholder:text-xs"
                            placeholder="نام محصول">
                    </div>

                    <span class="text-sm mr-4 hidden">
                        <span>نتایج جستجو برای</span>
                        <span id="search-inp-value"></span>
                    </span>

                    <ul class="mx-4 flex flex-col gap-y-2">
                        <a href=""
                            class="bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 hover-transition rounded-lg p-2 flex items-center gap-x-2">
                            <img class="w-20 rounded-lg" src="../images/product-1.jfif" alt="">
                            <span class="flex flex-col gap-y-1">
                                <span class="text-sm font-bold">گوشی سامسونگ گلکسی اس 22</span>
                                <span class="text-xs">در دسته بندی گوشی موبایل</span>
                            </span>
                        </a>

                        </a>
                    </ul>
                </div>

            </section>

            <!-- search window ends -->
        </div>
        <div class="col-span-4 md:col-span-3 grid grid-cols-4 lg:flex lg:justify-end gap-x-2 items-center">

            @if (auth()->user())
                <div class="col-span-2 sm:col-span-3 flex justify-end">

                    <!-- user popup starts -->
                    <button id="user-popup-btn" onclick="userPopupToggle()"
                        class="relative text-gray-700 dark:text-gray-200 w-10 sm:w-fit sm:px-2 lg:px-4 h-10 rounded-lg text-xl hover-transition hover:bg-gray-100 dark:hover:bg-gray-700">
                        <span class="flex-center gap-x-2">
                            <i class="fa-solid fa-user"></i>
                            <span
                                class="text-xs hidden sm:inline">{{ auth()->user()->fullName === ' ' ? Str::limit(auth()->user()->email, 15, '...') : Str::limit(auth()->user()->fullName, 15, '...') }}</span>
                        </span>
                        <div
                            class="hidden flex-col absolute top-12 left-0 w-48 bg-gray-100 dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                            <a href=""
                                class="text-base flex gap-x-1 items-center py-2 hover-transition hover:bg-gray-200 dark:hover:bg-gray-700">
                                <i class="fa-solid fa-square-user mr-2"></i>
                                <span class="text-xs">پروفایل کاربری</span>
                            </a>
                            <a href=""
                                class="text-base flex gap-x-1 items-center py-2 hover-transition hover:bg-gray-200 dark:hover:bg-gray-700">
                                <i class="fa-solid fa-square-list mr-2"></i>
                                <span class="text-xs">لیست سفارشات</span>
                            </a>
                            <a href=""
                                class="text-base flex gap-x-1 items-center py-2 hover-transition hover:bg-gray-200 dark:hover:bg-gray-700">
                                <i class="fa-solid fa-heart mr-2"></i>
                                <span class="text-xs">علاقه مندی ها</span>
                            </a>
                            <a href="{{ route('auth.logout') }}"
                                class="text-base flex gap-x-1 items-center py-2 hover-transition hover:bg-gray-200 dark:hover:bg-gray-700">
                                <i class="fa-solid fa-right-from-bracket mr-2"></i>
                                <span class="text-xs">خروج از حساب کاربری</span>
                            </a>
                        </div>
                    </button>
                    <!-- user popup ends -->
                </div>
            @else
                <div class="col-span-2 sm:col-span-3 flex justify-end">

                    <a href="{{ route('auth.index') }}"
                        class="flex-center text-gray-700 dark:text-gray-200 w-10 sm:w-fit sm:px-2 lg:px-4 h-10 rounded-lg text-xl hover-transition hover:bg-gray-100 dark:hover:bg-gray-700">

                        <span class="flex-center gap-x-2">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <span class="text-xs hidden sm:inline">ورود | ثبت نام</span>
                        </span>
                    </a>
                </div>
            @endif

            <div class="col-span-2 sm:col-span-1 flex justify-end">

                <!-- cart popup starts -->
                <button id="cart-popup-btn" onclick="cartPopupToggle()"
                    class="relative text-gray-700 dark:text-gray-200 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fa-solid fa-basket-shopping-simple"></i>

                        <div id="cart-alert-number"
                            class="@if ($cart_items->count() == 0) hidden @else flex-center @endif h-5 w-5 rounded-lg bg-red-600 text-white absolute -bottom-1 -right-1 text-xs">
                            {{ $cart_items->count() }}</div>


                    <div id="cart-dropdown" onclick="event.stopPropagation()"
                        class="hidden flex-col absolute top-12 left-0 w-64 bg-gray-50 dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">

                        <div
                            class="flex justify-between items-center border-b-2 dark:border-gray-700 border-gray-100 text-xs py-3">
                            <span class="mr-2">{{ $cart_items->count() }} کالا</span>
                            <a href="" class="text-blue-600 dark:text-blue-400 flex items-center gap-x-2 ml-2">
                                برو به سبد خرید
                                <i class="fa-duotone fa-arrow-left"></i>
                            </a>
                        </div>

                        @if ($cart_items->count() > 0)

                            <ul class="flex flex-col">

                                @foreach ($cart_items as $cart_item)
                                    <li
                                        class="grid grid-cols-6 gap-2 items-center py-2 border-b dark:border-gray-700 last:border-none hover-transition hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <div class="col-span-2 mr-2 rounded-lg overflow-hidden">
                                            <img class="w-full"
                                                src="{{ asset('storage\\' . $cart_item->product->image['indexArray']['medium']) }}"
                                                alt="">
                                        </div>
                                        <div class="col-span-3 text-right">
                                            <span class="text-xs leading-6">{{ $cart_item->product->name }}</span>
                                        </div>
                                        <span class="col-span-1 text-red-500 ml-2">
                                            <i class="fa-duotone fa-trash-list"></i>
                                        </span>
                                    </li>
                                @endforeach


                            </ul>

                            <div class="flex flex-col gap-3 pt-2 border-t-2 border-gray-100 dark:border-gray-700">

                                @php
                                    $pay_price = 0;
                                    $discount_price = 0;
                                    foreach ($cart_items as $cart_item) {
                                        $pay_price += $cart_item->product->price;
                                        if(!empty($cart_item->product->amazingSale->first())) {
                                            $discount_price=+ ($cart_item->product->amazingSale->first()->percentage * $cart_item->product->price) /100;
                                        }
                                    }

                                    $total_pay_price = $pay_price - $discount_price;
                                @endphp
                                <span class="flex justify-between text-xs mx-2">
                                    <span>جمع سبد خرید شما :</span>
                                    <span>{{ price_formater($pay_price) }} تومان</span>
                                </span>
                                <span class="flex justify-between text-xs mx-2 text-red-500">
                                    <span>تخفیف ها</span>
                                    <span>{{ price_formater($discount_price) }} تومان</span>
                                </span>
                                <span class="flex justify-between text-xs mx-2">
                                    <span>مبلغ پرداختی</span>
                                    <span>{{ price_formater($total_pay_price) }} تومان</span>
                                </span>

                                <a href="" class="btn text-sm bg-emerald-700 text-white m-2">ثبت سفارش</a>
                            </div>
                        @else
                            <span class="py-3 flex flex-col justify-center gap-3">
                                <i class="fa-light fa-cart-circle-xmark text-4xl md:text-6xl"></i>
                                <span class="text-xs"> سبد خرید شما خالیه :(</span>
                            </span>
                        @endif

                    </div>
                </button>
                <!-- cart popup ends -->

            </div>

        </div>
    </section>

</header>
