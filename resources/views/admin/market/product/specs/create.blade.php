@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | محصولات | مشخصات محصول | ثبت مشخصات محصول</title>
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
        <a href="{{ route('admin.market.product.spec.index', $product->id) }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">مشخصات محصول ({{ $product->name }})</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">ثبت مشخصات محصول</span>

    </section>
@endsection
@section('content')

    <section class="flex flex-col gap-y-2 p-2 w-full">

        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">ثبت مشخصات محصول</span>
            <a href="{{ route('admin.market.product.spec.index', $product->id) }}"
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


        <form class="w-full" action="{{ route('admin.market.product.spec.store', $product->id) }}" method="POST"
            enctype="multipart/form-data" id="form">
            @csrf

            <section class="w-full grid grid-cols-2 gap-2">
                @foreach ($product->category->specs as $key => $spec)
                    <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                        <label for="value-{{ $spec->id }}"
                            class="text-xs {{ $errors->has("value.$key") ? 'text-red-600 dark:text-red-400' : '' }}">{{ $spec->name }}</label>
                        <input type="text" class="form-input" name="value[]" id="value-{{ $spec->id }}"
                            value="{{ old('value.' . $spec->id, $spec->default_value) }}">
                    </div>
                @endforeach


                <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
            </section>
        </form>
    </section>

@endsection
