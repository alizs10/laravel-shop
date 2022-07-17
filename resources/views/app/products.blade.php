@extends('app.layouts.master')r

@section('head-tag')
    <meta name="csrf-token" content="{{ Session::token() }}">
@endsection

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

        @foreach ($products as $product)
            <div class="col-span-1 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
                <a href="{{ route('app.product.index', $product->id) }}" class="w-full">
                    <img src="{{ asset('storage\\' . $product->image['indexArray']['medium']) }}" alt="">
                </a>
                @php
                    $product_prices = $product->getPrice([], true);
                @endphp
                <div class="flex justify-between items-center">
                    <span class="flex flex-col gap-y-1 text-xs">
                        <span class="flex gap-x-2 items-center">
                            <span class="line-through">{{ price_formater($product_prices['product_price']) }}</span>
                            <div class="h-7 w-7 rounded-lg bg-red-600 text-white flex-center text-xs">
                                {{ e2p_numbers($product->amazingSale->percentage) }}%</div>
                        </span>
                        <span
                            class="text-red-500 font-bold">{{ price_formater($product_prices['ultimate_price']) }}</span>
                        <span class="text-red-500 font-bold">تومان</span>
                    </span>

                    <div class="flex flex-col items-center gax-y-2">
                        <button onclick="addToFavorites(this)"
                            data-url="{{ route('app.user.favorites.toggle', $product->id) }}"
                            class="@if (auth()->user() && $product->isFavorite(auth()->user()->id)) text-red-500 @else text-gray-700 @endif w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                        <button onclick="addToCart(this)"
                            data-url="{{ route('app.product.toggle-product', $product->id) }}"
                            class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                            @if ($cart_items->count() > 0)
                                @php
                                    $is_item_in_cart = $product->isInCart([], true);
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
    <!-- products ends -->
@endsection
