@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | محصولات | رنگ های محصول | ویرایش رنگ</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.market.product.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">محصولات</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.market.product.color.index', $color->product_id) }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">رنگ های محصول ({{ $color->product->name }})</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">ویرایش رنگ</span>

    </section>
@endsection
@section('content')

    <section class="flex flex-col gap-y-2 p-2 w-full">

        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">ویرایش رنگ</span>
            <a href="{{ route('admin.market.product.color.index', $color->product_id) }}"
                class="btn bg-blue-600 text-white">بازگشت</a>
        </div>

        @if ($errors->any())
            <div class="flex flex-col gap-y-1 rounded-lg bg-red-200 p-2">
                <span class="text-xs">خطا های فرم:</span>
                @foreach ($errors->all() as $error)
                    <div class="flex gap-x-1 text-red-600 items-center">
                        <span class="text-base">
                            <i class="fa-light fa-diamond-exclamation"></i>
                        </span>
                        <span class="text-sm">{{ $error }}</span>
                    </div>
                @endforeach

            </div>
        @endif


        <form class="w-full" action="{{ route('admin.market.product.color.update', $color->id) }}" method="POST"
            enctype="multipart/form-data" id="form">
            @csrf
            @method('put')
            <section class="w-full grid grid-cols-2 gap-2">

                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="color_name"
                        class="text-xs {{ $errors->has('color_name') ? 'text-red-600 dark:text-red-400' : '' }}">نام
                        رنگ</label>
                    <input type="text" class="form-input" name="color_name" id="color_name"
                        value="{{ old('color_name', $color->color_name) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="price_increase"
                        class="text-xs {{ $errors->has('price_increase') ? 'text-red-600 dark:text-red-400' : '' }}">افزایش
                        قیمت</label>
                    <input type="text" class="form-input" name="price_increase" id="price_increase"
                        value="{{ old('price_increase', $color->price_increase) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="color_code"
                        class="text-xs {{ $errors->has('color_code') ? 'text-red-600 dark:text-red-400' : '' }}">کد
                        رنگ</label>
                    <input type="text" class="form-input" name="color_code" id="color_code"
                        value="{{ old('color_code', $color->color_code) }}">
                </div>


                <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
            </section>
        </form>
    </section>

@endsection
