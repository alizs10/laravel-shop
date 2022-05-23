@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/selectize/css/selectize.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/selectize-correction.css') }}">
    <title>پنل ادمین | بخش محتوی | دسته بندی ها | ویرایش دسته بندی</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش محتوی</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.content.category.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">سوالات متداول</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">ویرایش دسته بندی</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">

        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">ویرایش دسته بندی</span>
            <a href="{{ route('admin.content.category.index') }}" class="btn bg-blue-600 text-white">بازگشت</a>
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


        <form class="w-full" action="{{ route('admin.content.category.update', $postCategory->id) }}"
            method="POST" enctype="multipart/form-data" id="form">
            @csrf
            @method('put')
            <section class="w-full grid grid-cols-2 gap-2">
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="name"
                        class="text-xs {{ $errors->has('name') ? 'text-red-600 dark:text-red-400' : '' }}">نام
                        دسته</label>
                    <input type="text" class="form-input" name="name" id="name"
                        value="{{ old('name', $postCategory->name) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="description"
                        class="text-xs {{ $errors->has('description') ? 'text-red-600 dark:text-red-400' : '' }}">توضیحات</label>
                    <input type="text" class="form-input" name="description" id="description"
                        value="{{ old('description', $postCategory->description) }}">
                </div>
                <div class="col-span-2  flex flex-col gap-y-1">
                    <label for="tags"
                        class="text-xs {{ $errors->has('tags') ? 'text-red-600 dark:text-red-400' : '' }}">تگ ها</label>
                    <input type="text" name="tags" id="input_tags" value="{{ old('tags', $postCategory->tags) }}">

                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="image"
                        class="text-xs {{ $errors->has('image') ? 'text-red-600 dark:text-red-400' : '' }}">تصویر</label>
                    <input type="file" class="form-input" name="image" id="image">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="status"
                        class="text-xs {{ $errors->has('status') ? 'text-red-600 dark:text-red-400' : '' }}">وضعیت</label>
                    <select name="status" id="status" class="form-select" style="direction: ltr">
                        <option value="1" @if (old('status', $postCategory->status) == 1) selected @endif>فعال</option>
                        <option value="0" @if (old('status', $postCategory->status) == 0) selected @endif>غیرفعال</option>
                    </select>
                </div>


                <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
            </section>
        </form>
    </section>


@endsection

@section('script')
    <script src="{{ asset('admin-assets/packages/selectize/js/selectize.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/select-tags.js') }}"></script>
@endsection
