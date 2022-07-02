@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | فرم کالا | مقادیر فرم کالا | ویرایش مقدار</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.market.property.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">فرم کالا</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.market.property.value.index', $value->category_attribute_id) }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">مقادیر فرم کالا ({{ $value->attribute->name }})</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">ویرایش مقدار</span>

    </section>
@endsection
@section('content')


    <section class="flex flex-col gap-y-2 p-2 w-full">

        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">ویرایش مقدار</span>
            <a href="{{ route('admin.market.property.value.index', $value->category_attribute_id) }}"
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


        <form class="w-full" action="{{ route('admin.market.property.value.update', $value->id) }}"
            method="POST" enctype="multipart/form-data" id="form">
            @csrf
            @method('put')
            <section class="w-full grid grid-cols-2 gap-2">
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="product_id"
                        class="text-xs {{ $errors->has('product_id') ? 'text-red-600 dark:text-red-400' : '' }}">محصول</label>
                    <select name="product_id" id="product_id" class="form-select" style="direction: ltr">
                        <option value="">محصول را انتخاب کنید</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" @if (old('product_id', $value->product_id) == $product->id) selected @endif>
                                {{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="value"
                        class="text-xs {{ $errors->has('value') ? 'text-red-600 dark:text-red-400' : '' }}">مقدار</label>
                    <input type="text" class="form-input" name="value" id="value" value="{{ old('value', json_decode($value->value)->value) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="price_increase"
                        class="text-xs {{ $errors->has('price_increase') ? 'text-red-600 dark:text-red-400' : '' }}">افزایش
                        قیمت</label>
                    <input type="text" class="form-input" name="price_increase" id="price_increase"
                        value="{{ old('price_increase', json_decode($value->value)->price_increase) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="price_increase"
                        class="text-xs {{ $errors->has('marketable_number') ? 'text-red-600 dark:text-red-400' : '' }}">تعداد موجودی</label>
                    <input type="text" class="form-input" name="marketable_number" id="marketable_number" value="{{ old('marketable_number',$value->marketable_number) }}">
                </div>

                <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
            </section>
        </form>
    </section>

@endsection
