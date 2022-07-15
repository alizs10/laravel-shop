@extends('app.layouts.master')

@section('content')
    <!-- comparison starts -->

    <section class="grid grid-cols-2 gap-2">
        @if (!empty($first_product))
            <section class="col-span-1 relative flex flex-col gap-y-2 border-l-2 border-gray-200 dark:border-gray-700">
                <a href="{{ route('app.product.index', $first_product->id) }}" class="mx-4 md:mx-auto text-center">
                    <img src="{{ asset('storage\\' . $first_product->image['indexArray']['medium']) }}"
                        class="rounded-lg w-full md:w-48" alt="">
                </a>
                <span class="text-xxs xs:text-xs text-center md:text-sm mx-4 leading-5 xs:leading-6">
                    {{ $first_product->name }}
                </span>
                <span class="text-xxs xs:text-xs text-center md:text-sm mx-4 text-red-500">
                    {{ price_formater($first_product->ultimate_price) }} تومان
                </span>


                <a @if ($second_product) href="{{ route('app.compare.index', $second_product->id) }}"
                @else
                href="{{ route('app.compare.index') }}" @endif
                    class="absolute flex-center -top-2 xs:-top-3 left-1 w-5 h-5 xs:w-7 xs:h-7 rounded-full bg-gray-200 dark:bg-gray-500">
                    <i class="fa-solid fa-xmark text-xs xs:text-base text-gray-500 dark:text-gray-800"></i>
                </a>
            </section>
        @else
            <section class="col-span-1 flex-center">
                <button onclick="compareProductsToggle()"
                    class="text-xxs xs:text-xs px-3 py-2 bg-red-500 rounded-lg text-white">
                    انتخاب کالا
                </button>

            </section>
        @endif
        @if (!empty($second_product))
            <section class="col-span-1 relative flex flex-col gap-y-2">
                <a href="{{ route('app.product.index', $second_product->id) }}" class="mx-4 md:mx-auto text-center">
                    <img src="{{ asset('storage\\' . $second_product->image['indexArray']['medium']) }}"
                        class="rounded-lg w-full md:w-48" alt="">
                </a>
                <span class="text-xxs xs:text-xs text-center md:text-sm mx-4 leading-5 xs:leading-6">
                    {{ $second_product->name }}
                </span>
                <span class="text-xxs xs:text-xs text-center md:text-sm mx-4 text-red-500">
                    {{ price_formater($second_product->ultimate_price) }} تومان
                </span>


                <a @if ($first_product) href="{{ route('app.compare.index', $first_product->id) }}" @endif
                    class="absolute flex-center -top-2 xs:-top-3 left-1 w-5 h-5 xs:w-7 xs:h-7 rounded-full bg-gray-200 dark:bg-gray-500">
                    <i class="fa-solid fa-xmark text-xs xs:text-base text-gray-500 dark:text-gray-800"></i>
                </a>
            </section>
        @else
            <section class="col-span-1 flex-center">
                <button onclick="compareProductsToggle()"
                    class="text-xxs xs:text-xs px-3 py-2 bg-red-500 rounded-lg text-white">
                    انتخاب کالا
                </button>

            </section>
        @endif

        @if ($first_product && $second_product)
            <section class="col-span-2 py-3 flex-center">
                <a href="{{ route('app.compare.index', [$second_product->id, $first_product->id]) }}"
                    class="flex-center gap-x-2 px-2 py-2 text-xxs xs:text-xs rounded-lg bg-white text-red-500 dark:bg-gray-700">
                    <i class="fa-light fa-arrow-right-arrow-left text-lg"></i>
                    جا به جایی
                </a>
            </section>
        @endif

        @if ($first_product)
            @php
                $specs = $first_product->category->specs;
                $specsArray = [];
                foreach ($specs as $spec) {
                    $specsArray[$spec->name] = [];
                }
                
                $first_product_specs = $first_product->specs;
                foreach ($first_product_specs as $first_product_spec) {
                    $specsArray[$first_product_spec->name][0] = $first_product_spec->value;
                }
                
                if ($second_product) {
                    $second_product_specs = $second_product->specs;
                
                    foreach ($second_product_specs as $second_product_spec) {
                        $specsArray[$second_product_spec->name][1] = $second_product_spec->value;
                    }
                }
            @endphp

            <section class="col-span-2 mx-2 mt-4 flex flex-col gap-y-2">
                @foreach ($specsArray as $specName => $specArr)
                    <span class="text-xxs xs:text-xs mt-2 md:mt-8 text-gray-500 dark:text-gray-400 text-center">
                        {{ $specName }}
                    </span>
                    <div class="grid grid-cols-2 gap-2">
                        <span class="text-xxs xs:text-xs border-l-2 border-gray-200 dark:border-gray-700 text-center">
                            {{ $specArr[0] }}
                        </span>

                        @if ($second_product)
                            <span class="text-xxs xs:text-xs text-center">
                                {{ $specArr[1] ?? '-' }}
                            </span>
                        @endif
                    </div>
                @endforeach

            </section>
        @endif

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

            <div
                class="@if (count($comparable_products) == 0) flex-center @else grid grid-cols-2 gap-4 @endif mt-2 h-[calc(100%_-_4.5rem)] overflow-y-scroll">
                @if (count($comparable_products) == 0)
                    <span class="text-xs">محصولی برای مقایسه وجود ندارد</span>
                @else
                    @foreach ($comparable_products as $comparable)
                        <section class="col-span-1 flex flex-col gap-y-2">
                            <a @if ($first_product) href="{{ route('app.compare.index', [$first_product->id, $comparable->id]) }}"
                                @else
                                href="{{ route('app.compare.index', $comparable->id) }}" @endif
                                class="mx-4 md:mx-auto md:w-48 rounded-lg overflow-hidden text-center">
                                <img src="{{ asset('storage\\' . $comparable->image['indexArray']['medium']) }}">
                            </a>
                            <span class="text-xxs xs:text-xs text-center md:text-sm mx-4">
                                {{ $comparable->name }}
                            </span>
                            <span class="text-xxs xs:text-xs text-center md:text-sm mx-4 text-red-500">
                                {{ price_formater($comparable->ultimate_price) }} تومان
                            </span>

                        </section>
                    @endforeach
                @endif

            </div>


        </div>

    </div>
    <!-- products to compare modal ends -->
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('app-assets/js/comparison-page.js') }}"></script>
@endsection
