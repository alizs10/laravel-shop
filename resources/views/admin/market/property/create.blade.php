@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | فرم کالا | فرم کالای جدید</title>
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
        <span class="text-xs md:text-base">ایجاد فرم کالای جدید</span>

    </section>
@endsection
@section('content')
  
<section class="flex flex-col gap-y-2 p-2 w-full">

    <div class="flex justify-between items-center">
        <span class="text-sm md:text-lg">ایجاد فرم کالای جدید</span>
        <a href="{{ route('admin.market.property.index') }}" class="btn bg-blue-600 text-white">بازگشت</a>
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


    <form class="w-full" action="{{ route('admin.market.property.store') }}" method="POST"
        enctype="multipart/form-data" id="form">
        @csrf

        <section class="w-full grid grid-cols-2 gap-2">
            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="name"
                    class="text-xs {{ $errors->has('name') ? 'text-red-600 dark:text-red-400' : '' }}">عنوان فرم کالا</label>
                <input type="text" class="form-input" name="name" id="name" value="{{ old('name') }}">
            </div>
            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="unit"
                    class="text-xs {{ $errors->has('unit') ? 'text-red-600 dark:text-red-400' : '' }}">واحد فرم کالا</label>
                <input type="text" class="form-input" name="unit" id="unit" value="{{ old('unit') }}">
            </div>

            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="type"
                    class="text-xs {{ $errors->has('type') ? 'text-red-600 dark:text-red-400' : '' }}">نوع فرم کالا</label>
                <select name="type" id="type" class="form-select" style="direction: ltr">
                    <option value="0" @if (old('type') == 0) selected @endif>ساده</option>
                    <option value="1" @if (old('type') == 1) selected @endif>انتخابی</option>
                </select>
            </div>

            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="cat_id"
                    class="text-xs {{ $errors->has('cat_id') ? 'text-red-600 dark:text-red-400' : '' }}">دسته</label>
                <select name="cat_id" id="cat_id" class="form-select" style="direction: ltr">
                    <option value="">دسته را انتخاب کنید</option>
                    @foreach ($productCategories as $cat)
                        <option value="{{ $cat->id }}" @if (old('cat_id') == $cat->id) selected @endif>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>


            <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
        </section>
    </form>
</section>  
@endsection
