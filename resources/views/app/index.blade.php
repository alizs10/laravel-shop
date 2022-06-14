@extends('app.layouts.master')

@section('content')
    <!-- slidershow starts -->
    <section class="grid grid-cols-12 gap-2 md:h-2/3 h-1/3">

        <section class="relative z-0 col-span-12 bg-white rounded-lg ltr overflow-hidden">

            <div id="slidershow-imgs" class="w-full flex flex-wrap overflow-hidden">
                @foreach ($slideshowBaners as $key => $slideshow)
                    <a class="w-full h-full inline-block text-center" href="{{ $slideshow->url }}">
                        <img id="slider-{{ $key + 1 }}" src="{{ asset('storage\\' . $slideshow->image) }}"
                            class="w-full @if ($key == 0) active @else hidden @endif" alt="slideshow">
                    </a>
                @endforeach

            </div>

            <div id="s-btns" class="absolute bottom-4 z-0 right-0 left-0 py-3 flex-center gap-x-2">
                @foreach ($slideshowBaners as $key => $slideshow)
                    <span id="s-btn-{{ $key + 1 }}"
                        class="transition-all duration-300 shadow-lg @if ($key == 0) bg-red-500 @else bg-white @endif w-4 h-3 rounded-lg cursor-pointer"></span>
                @endforeach

            </div>
        </section>

    </section>
    <!-- slidershow ends -->

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

            @foreach ($amazingSaleProducts as $amazingSale)
                <a href="{{ route('app.product.index', $amazingSale->id) }}" class="flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
                    <img class="w-32"
                        src="{{ asset('storage\\' . $amazingSale->product->image['indexArray']['medium']) }}" alt="">
                    <div class="flex justify-between items-center">
                        <span class="flex flex-col gap-y-1 text-xs">
                            <span class="flex gap-x-2 items-center">
                                <span class="line-through">{{ $amazingSale->product->price }}</span>
                                <div class="h-7 w-7 rounded-lg bg-red-600 text-white flex-center text-xs">
                                    {{ $amazingSale->percentage }}%</div>
                            </span>
                            <span class="text-red-500 font-bold">{{ $amazingSale->price }}</span>
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
    <!-- amazing sales ends -->


    <!-- add starts -->
    <section class="rounded-lg my-4 overflow-hidden">
        <a href="{{ $banerOne->url }}" target="_blank">
            <img class="w-full" src="{{ asset('storage\\' . $banerOne->image) }}" alt="advertisement-baner">
        </a>
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

            @foreach ($leastMarketableProducts as $leastMarketableProduct)
                <div class="flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
                    <img class="w-32"
                        src="{{ asset('storage\\' . $leastMarketableProduct->image['indexArray']['medium']) }}" alt="">
                    <div class="flex justify-between items-center">

                        @if (!is_null($leastMarketableProduct->amazingSale))
                            <span class="flex flex-col gap-y-1 text-xs">
                                <span class="flex gap-x-2 items-center">
                                    <span class="line-through">{{ $leastMarketableProduct->price }}</span>
                                    <div class="h-7 w-7 rounded-lg bg-red-600 text-white flex-center text-xs">
                                        {{ $leastMarketableProduct->amazingSale->percentage }}%</div>
                                </span>
                                <span
                                    class="text-red-500 font-bold">{{ $leastMarketableProduct->amazingSale->price }}</span>
                                <span class="text-red-500 font-bold">تومان</span>
                            </span>
                        @else
                            <span class="flex flex-col gap-y-1 text-xs">
                                <span>{{ $leastMarketableProduct->price }}</span>
                                <span class="font-bold">تومان</span>
                            </span>
                        @endif

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
                </div>
            @endforeach



        </div>
    </section>
    <!-- recommended products ends -->

    <!-- add starts -->
    <section class="rounded-lg my-4 overflow-hidden">
        <a href="{{ $banerTwo->url }}" target="_blank">
            <img class="w-full" src="{{ asset('storage\\' . $banerTwo->image) }}" alt="advertisement-baner">
        </a>
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
                        <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                        <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
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
                        <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                        <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
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
                        <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                        <button class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                            <i class="fa-solid fa-cart-circle-plus"></i>
                        </button>
                    </div>
                </div>
            </div>



        </div>
    </section>
    <!-- visited products ends -->

    <!-- add starts -->
    <section class="rounded-lg my-4 overflow-hidden">
        <a href="{{ $banerThree->url }}" target="_blank">
            <img class="w-full" src="{{ asset('storage\\' . $banerThree->image) }}" alt="advertisement-baner">
        </a>
    </section>
    <!-- add ends -->

    <!-- best brands starts -->
    <section class="flex flex-col gap-y-2 p-2 rounded-lg mt-4 bg-gray-300 dark:bg-gray-700 text-white">
        <div class="flex justify-between items-center text-black dark:text-white text-base">
            <span>بهترین برند ها</span>
            <a href="" class="flex-center gap-x-2">
                <span>بیشتر</span>
                <i class="fa-duotone fa-arrow-left text-base"></i>
            </a>
        </div>

        <div class="flex flex-row gap-x-4 py-3 overflow-x-scroll no-scrollbar">

            @foreach ($brands as $brand)
                
            <a href="" class="rounded-lg bg-white text-black p-2 hover-transition hover:scale-110 overflow-hidden">
                <img class="w-32" src="{{ asset('storage\\'. $brand->logo['indexArray']['small']) }}" alt="brand">
            </a>
            @endforeach
           



        </div>
    </section>
    <!-- best brands ends -->
@endsection

@section('scripts')
    <script src="{{ asset('app-assets/js/slidershow.js') }}"></script>
    <script src="{{ asset('app-assets/js/products.js') }}"></script>
@endsection
