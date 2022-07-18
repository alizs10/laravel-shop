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
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs xs:text-sm md:text-base text-red-500">
            @if ($orders_type == 0)
                در انتظار پرداخت
            @elseif($orders_type == 1)
                در حال پردازش
            @elseif($orders_type == 2)
                تحویل شده
            @elseif($orders_type == 3)
                لغو شده
            @elseif($orders_type == 4)
                مرجوعی
            @endif
        </span>


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
            @php
                $user_orders = auth()
                    ->user()
                    ->orders;
                
                $still_orders = $user_orders->where('order_status', 0);
                $proccessing_orders = $user_orders->where('order_status', 1);
                $delivered_orders = $user_orders->where('order_status', 2);
                $canceled_orders = $user_orders->where('order_status', 3);
                $returned_orders = $user_orders->where('order_status', 4);
            @endphp
            <div class="grid grid-cols-3 xs:grid-cols-5 mt-2 bg-white dark:bg-gray-700 rounded-lg overflow-hidden">
                <a href="{{ route('app.user.orders') . '?type=0' }}"
                    class="col-span-1 px-3 py-2 flex-center gap-2 text-sm cursor-pointer @if ($orders_type == 0) bg-gray-200 dark:bg-gray-900 @else hover-transition hover:bg-gray-200 hover:dark:bg-gray-900 @endif">
                    <span class="text-lg lg:text-xl xs:text-3xl">
                        <i class="fa-light fa-clock"></i>
                    </span>
                    <span class="hidden lg:block">در انتظار پرداخت</span>

                    @if (count($still_orders) > 0)
                        <span
                            class="w-6 h-6 bg-red-500 flex-center text-white text-xs rounded-lg">{{ e2p_numbers(count($still_orders)) }}</span>
                    @endif
                </a>
                <a href="{{ route('app.user.orders') . '?type=1' }}"
                    class="col-span-1 px-3 py-2 flex-center gap-2 text-sm cursor-pointer @if ($orders_type == 1) bg-gray-200 dark:bg-gray-900 @else hover-transition hover:bg-gray-200 hover:dark:bg-gray-900 @endif">
                    <span class="text-lg lg:text-xl xs:text-3xl text-blue-600 dark:text-blue-500">
                        <i class="fa-light fa-loader"></i>
                    </span>
                    <span class="hidden lg:block">در حال پردازش</span>
                   
                    @if (count($proccessing_orders) > 0)
                        <span
                            class="w-6 h-6 bg-red-500 flex-center text-white text-xs rounded-lg">{{ e2p_numbers(count($proccessing_orders)) }}</span>
                    @endif
                </a>
                <a href="{{ route('app.user.orders') . '?type=2' }}"
                    class="col-span-1 px-3 py-2 flex-center gap-2 text-sm cursor-pointer @if ($orders_type == 2) bg-gray-200 dark:bg-gray-900 @else hover-transition hover:bg-gray-200 hover:dark:bg-gray-900 @endif">
                    <span class="text-lg lg:text-xl xs:text-3xl text-emerald-600">
                        <i class="fa-light fa-hexagon-check"></i>
                    </span>
                    <span class="hidden lg:block">تحویل شده</span>
                    @if (count($delivered_orders) > 0)
                        <span
                            class="w-6 h-6 bg-red-500 flex-center text-white text-xs rounded-lg">{{ e2p_numbers(count($delivered_orders)) }}</span>
                    @endif
                </a>

                <a href="{{ route('app.user.orders') . '?type=3' }}"
                    class="col-span-1 px-3 py-2 flex-center gap-2 text-sm cursor-pointer @if ($orders_type == 3) bg-gray-200 dark:bg-gray-900 @else hover-transition hover:bg-gray-200 hover:dark:bg-gray-900 @endif">
                    <span class="text-lg lg:text-xl xs:text-3xl text-red-500">
                        <i class="fa-light fa-hexagon-xmark"></i>
                    </span>
                    <span class="hidden lg:block">لغو شده</span>
                    @if (count($canceled_orders) > 0)
                        <span
                            class="w-6 h-6 bg-red-500 flex-center text-white text-xs rounded-lg">{{ e2p_numbers(count($canceled_orders)) }}</span>
                    @endif
                </a>
                <a href="{{ route('app.user.orders') . '?type=4' }}"
                    class="col-span-1 px-3 py-2 flex-center gap-2 text-sm cursor-pointer @if ($orders_type == 4) bg-gray-200 dark:bg-gray-900 @else hover-transition hover:bg-gray-200 hover:dark:bg-gray-900 @endif">
                    <span class="text-lg lg:text-xl xs:text-3xl text-orange-500">
                        <i class="fa-light fa-arrow-rotate-left"></i>
                    </span>
                    <span class="hidden lg:block">مرجوعی</span>
                    @if (count($returned_orders) > 0)
                        <span
                            class="w-6 h-6 bg-red-500 flex-center text-white text-xs rounded-lg">{{ e2p_numbers(count($returned_orders)) }}</span>
                    @endif
                </a>
            </div>

            <!-- orders list starts -->
            <div class="flex flex-col gap-2 mt-2">

                @foreach ($orders as $order)
                    <div class="flex flex-col gap-2 rounded-lg bg-white dark:bg-gray-700 shadow-md p-3">
                        <span class="flex justify-between pb-2 border-b-2 boder-gray-100 dark:border-gray-600">
                            <span class="flex gap-2 text-xxxs xs:text-xs text-gray-500 dark:text-gray-400">
                                <span>{{ e2p_numbers(showPersianDate($order->created_at)) }}</span>
                                <span class="flex-center text-xxxs">
                                    <i class="fa-solid fa-circle"></i>
                                </span>
                                <span>LSC-{{ $order->id }}</span>
                                <span class="flex-center text-xxxs">
                                    <i class="fa-solid fa-circle"></i>
                                </span>
                                <span class="text-blue-600 dark:text-blue-500">{{ $order->status() }}</span>
                            </span>
                        </span>

                        <div
                            class="grid grid-cols-6 xs:grid-cols-10 gap-2 pb-2 border-b-2 boder-gray-100 dark:border-gray-600">

                            @foreach ($order->items as $order_item)
                                <a href="{{ route('app.product.index', $order_item->product_id) }}"
                                    class="col-span-2 lg:col-span-1 rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $order_item->product->image['indexArray']['medium']) }}"
                                        alt="">
                                </a>
                            @endforeach

                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs xs:text-sm">{{ price_formater(($order->order_final_amount + $order->delivery_amount)) }}
                                تومان</span>

                            <div class="flex gap-2">
                                <a class="px-3 py-2 xs:px-4 xs:py-3 text-xs flex-center gap-2 rounded-lg text-white bg-gray-500"
                                    href="">
                                    <i class="fa-light fa-receipt"></i>
                                    فاکتور
                                </a>
                                <a class="px-3 py-2 xs:px-4 xs:py-3 text-xs flex-center gap-2 rounded-lg text-white bg-emerald-600"
                                    href="{{ route('app.user.orders.details', $order->id) }}">
                                    <i class="fa-light fa-info"></i>
                                    جزییات
                                </a>
                                @if ($order->order_status == 0)
                                    <a class="px-3 py-2 xs:px-4 xs:py-3 text-xs flex-center gap-2 rounded-lg text-white bg-red-500"
                                        href="{{ route('app.shipping.index', $order->id) }}">
                                        <i class="fa-light fa-info"></i>
                                        پرداخت
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
            <!-- orders list ends -->

        </div>

    </section>
    <!-- orders ends -->
@endsection


@section('scripts')
    <script src="{{ asset('app-assets/js/orders-page.js') }}"></script>
@endsection
