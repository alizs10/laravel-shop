@extends('app.layouts.master')r

@section('content')
    <!-- breadcrumb starts-->
    <section
        class="px-2 py-4 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white flex flex-wrap items-center gap-1 md:gap-2">

        <a href="{{ route('app.home') }}" class="text-xs md:text-base text-red-500">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs md:text-base">برندها</span>

    </section>
    <!-- breadcrumb ends -->

    <!-- products starts -->
    <section
        class="mt-4 p-3 grid grid-cols-1 xs:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-2 rounded-lg bg-gray-100 dark:bg-gray-800">

        @if ($brands->count() > 0)
            @foreach ($brands as $brand)
                <div class="col-span-1 flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
                    <a href="{{ route('app.products.brand-products', $brand->id) }}" class="w-full">
                        <img src="{{ asset('storage\\' . $brand->logo['indexArray']['medium']) }}" alt="">
                    </a>
                </div>
            @endforeach
        @else
            <div class="col-span-8 flex flex-col justify-center gap-y-2 text-gray-500 dark:text-gray-400">
                <i class="fa-light fa-face-frown text-9xl"></i>
                <span class="text-center">برندی یافت نشد‍</span>
            </div>
        @endif





    </section>
    <!-- products ends -->
@endsection
