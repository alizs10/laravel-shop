@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/selectize/css/selectize.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/selectize-correction.css') }}">
    <title>پنل ادمین | بخش فروش | دسته بندی | اضافه کردن مشخصات کالا</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.market.category-spec.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">مشخصات کالا</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">اضافه کردن مشخصات کالا</span>

    </section>
@endsection
@section('content')
    <form class="w-full" action="{{ route('admin.market.category-spec.store', $productCategory->id) }}"
        method="POST" enctype="multipart/form-data" id="form">
        @csrf
        <section class="flex flex-col gap-y-2 p-2 w-full">

            <div class="flex justify-between items-center">
                <span class="text-sm md:text-lg">اضافه کردن مشخصات کالا</span>
                <div class="flex gap-2">
                    <a href="{{ route('admin.market.category-spec.index') }}" class="btn bg-blue-600 text-white">بازگشت</a>
                    <button type="submit" class="btn bg-emerald-600 text-white">ثبت</button>
                </div>
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




            <section class="w-full grid grid-cols-10 gap-2">
                <div class="col-span-3 flex flex-col gap-y-1">
                    <label for="name"
                        class="text-xs {{ $errors->has('name') ? 'text-red-600 dark:text-red-400' : '' }}">نام</label>
                    <input type="text" class="form-input" name="name" id="name" value="{{ old('name') }}">
                </div>
                <div class="col-span-3 flex flex-col gap-y-1">
                    <label for="default_value"
                        class="text-xs {{ $errors->has('default_value') ? 'text-red-600 dark:text-red-400' : '' }}">مقدار
                        پیش فرض</label>
                    <input type="text" class="form-input" name="default_value" id="default_value"
                        value="{{ old('default_value') }}">
                </div>

                <div class="col-span-3 flex flex-col gap-y-1">
                    <label for="status"
                        class="text-xs {{ $errors->has('status') ? 'text-red-600 dark:text-red-400' : '' }}">وضعیت</label>
                    <select name="status" id="status" class="form-select" style="direction: ltr">
                        <option value="1" selected>فعال</option>
                        <option value="0">غیرفعال</option>
                    </select>
                </div>
                <button type="button" id="add-spec" class="col-span-1 btn bg-gray-300 dark:bg-gray-700 text-xl">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </section>

            <section id="specs" class="flex flex-col gap-2 text-base pt-3 border-t-2 border-slate-300 dark:border-gray-700">

            </section>
        </section>
    </form>

@endsection

@section('script')
    <script src="{{ asset('admin-assets/js/category-specs.js') }}"></script>
@endsection
