@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | ویرایش تنظیمات</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.setting.index') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">بخش
            تنظیمات</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs md:text-base">ویرایش تنظیمات</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <span class="text-sm md:text-lg">افزودن محصول جدید</span>
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


        <form class="w-full" action="{{ route('admin.setting.update', $setting->id) }}" method="POST"
            enctype="multipart/form-data" id="form">
            @csrf
            {{ method_field('put') }}
            <section class="w-full grid grid-cols-2 gap-2">
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="title" class="text-xs {{ $errors->has('title') ? 'text-red-600 dark:text-red-400' : '' }}">عنوان سایت</label>
                    <input type="text" class="form-input" name="title" id="title"
                        value="{{ old('title', $setting->title) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="description" class="text-xs {{ $errors->has('description') ? 'text-red-600 dark:text-red-400' : '' }}">توضیحات
                        سایت</label>
                    <input type="text" class="form-input" name="description" id="description"
                        value="{{ old('description', $setting->description) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="keywords" class="text-xs {{ $errors->has('keywords') ? 'text-red-600 dark:text-red-400' : '' }}">کلمات کلیدی
                        سایت</label>
                    <input type="text" class="form-input" name="keywords" id="keywords"
                        value="{{ old('keywords', $setting->keywords) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="logo" class="text-xs {{ $errors->has('logo') ? 'text-red-600 dark:text-red-400' : '' }}">لوگو سایت</label>
                    <input type="file" class="form-input" name="logo" id="logo">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="icon" class="text-xs {{ $errors->has('icon') ? 'text-red-600 dark:text-red-400' : '' }}">آیکون سایت</label>
                    <input type="file" class="form-input" name="icon" id="icon">
                </div>

                <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
            </section>
        </form>
    </section>
@endsection
