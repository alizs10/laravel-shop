@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش اطلاع رسانی | ایجاد فایل جدید</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش اطلاع رسانی</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.notify.email.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">اطلاعیه ایمیلی</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.notify.email-files.index', $email->id) }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">فایل های اطلاعیه ایمیلی</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">{{ $email->subject }}</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">ایجاد فایل جدید</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">

        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">ایجاد فایل جدید</span>
            <a href="{{ route('admin.notify.email-files.index', $email->id) }}"
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


        <form class="w-full" action="{{ route('admin.notify.email-files.store', $email->id) }}" method="POST"
            enctype="multipart/form-data" id="form">
            @csrf

            <section class="w-full grid grid-cols-2 gap-2">
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="file"
                        class="text-xs {{ $errors->has('file') ? 'text-red-600 dark:text-red-400' : '' }}">فایل ضمیمه
                    </label>
                    <input type="file" class="form-input" name="file" id="file">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="file_name"
                        class="text-xs {{ $errors->has('file_name') ? 'text-red-600 dark:text-red-400' : '' }}">نام فایل
                    </label>
                    <input type="text" class="form-input" name="file_name" id="file_name"
                        value="{{ old('file_name') }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="file_description"
                        class="text-xs {{ $errors->has('file_description') ? 'text-red-600 dark:text-red-400' : '' }}">توضیحات
                        فایل
                    </label>
                    <input type="text" class="form-input" name="file_description" id="file_description"
                        value="{{ old('file_description') }}">
                </div>

                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="file_save_path"
                        class="text-xs {{ $errors->has('file_save_path') ? 'text-red-600 dark:text-red-400' : '' }}">وضعیت</label>
                    <select name="file_save_path" id="file_save_path" class="form-select" style="direction: ltr">
                        <option value="">محل دخیره را مشخص کنید</option>
                        <option value="0" @if (old('file_save_path') === 1) selected @endif>عمومی</option>
                        <option value="1" @if (old('file_save_path') === 0) selected @endif>خصوصی</option>
                    </select>
                </div>


                <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
            </section>
        </form>
    </section>
@endsection
