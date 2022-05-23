@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | پست ها | ایجاد پست جدید</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/selectize/css/selectize.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/selectize-correction.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش محتوی</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.content.post.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">پست ها</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">ایجاد پست جدید</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">

        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">ایجاد پست جدید</span>
            <a href="{{ route('admin.content.post.index') }}" class="btn bg-blue-600 text-white">بازگشت</a>
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


        <form class="w-full" action="{{ route('admin.content.post.store') }}" method="POST"
            enctype="multipart/form-data" id="form">
            @csrf

            <section class="w-full grid grid-cols-2 gap-2">
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="title"
                        class="text-xs {{ $errors->has('title') ? 'text-red-600 dark:text-red-400' : '' }}">عنوان
                        پست</label>
                    <input type="text" class="form-input" name="title" id="title" value="{{ old('title') }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="summary"
                        class="text-xs {{ $errors->has('summary') ? 'text-red-600 dark:text-red-400' : '' }}">خلاصه</label>
                    <input type="text" class="form-input" name="summary" id="summary" value="{{ old('summary') }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="image"
                        class="text-xs {{ $errors->has('image') ? 'text-red-600 dark:text-red-400' : '' }}">تصویر</label>
                    <input type="file" class="form-input" name="image" id="image">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="cat_id"
                        class="text-xs {{ $errors->has('cat_id') ? 'text-red-600 dark:text-red-400' : '' }}">دسته</label>
                    <select name="cat_id" id="cat_id" class="form-select" style="direction: ltr">
                        <option value="">یک دسته را انتخاب کنید</option>
                        @foreach ($postCategories as $cat)
                            <option value="{{ $cat->id }}" @if ($cat->id == old('cat_id')) selected @endif>
                                {{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2  flex flex-col gap-y-1">
                    <label for="tags"
                        class="text-xs {{ $errors->has('tags') ? 'text-red-600 dark:text-red-400' : '' }}">تگ ها</label>
                    <input type="text" name="tags" id="input_tags" value="{{ old('tags') }}">

                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="published_at"
                        class="text-xs {{ $errors->has('published_at') ? 'text-red-600 dark:text-red-400' : '' }}">تاریخ
                        انتشار
                    </label>
                    <input type="hidden" name="published_at" id="published_at">
                    <input type="text" class="form-input" name="published_at_view" id="published_at_view" readonly>
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="status"
                        class="text-xs {{ $errors->has('commentable') ? 'text-red-600 dark:text-red-400' : '' }}">نظرات برای این پست</label>
                    <select name="commentable" id="commentable" class="form-select" style="direction: ltr">
                        <option value="1" @if (old('commentable') == 1) selected @endif>فعال</option>
                        <option value="0" @if (old('commentable') == 0) selected @endif>غیرفعال</option>
                    </select>
                </div>
                <div class="col-span-2 flex flex-col gap-y-1">
                    <label for="status"
                        class="text-xs {{ $errors->has('status') ? 'text-red-600 dark:text-red-400' : '' }}">وضعیت</label>
                    <select name="status" id="status" class="form-select" style="direction: ltr">
                        <option value="1" @if (old('status') == 1) selected @endif>فعال</option>
                        <option value="0" @if (old('status') == 0) selected @endif>غیرفعال</option>
                    </select>
                </div>
                
                <div class="col-span-2 flex flex-col gap-y-1">
                    <label for="body"
                        class="text-xs {{ $errors->has('body') ? 'text-red-600 dark:text-red-400' : '' }}">متن</label>
                    <textarea rows="6" class="form-input" name="body" id="cke">{{ old('body') }}</textarea>
                </div>

                <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
            </section>
        </form>
    </section>

@endsection

@section('script')
<script src="{{ asset('admin-assets/packages/selectize/js/selectize.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/select-tags.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/js/ckreplace.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/jalali-persian-date.js') }}"></script>
@endsection
