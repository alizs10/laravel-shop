@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش کاربران | ادمین ها | ادمین جدید</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش کاربران</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.user.admin-user.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">ادمین ها</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">ادمین جدید</span>

    </section>
@endsection
@section('content')
<section class="flex flex-col gap-y-2 p-2 w-full">

    <div class="flex justify-between items-center">
        <span class="text-sm md:text-lg">ادمین جدید</span>
        <a href="{{ route('admin.user.admin-user.index') }}" class="btn bg-blue-600 text-white">بازگشت</a>
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


    <form class="w-full" action="{{ route('admin.user.admin-user.store') }}" method="POST" enctype="multipart/form-data" id="form">
        @csrf

        <section class="w-full grid grid-cols-2 gap-2">
            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="first_name"
                    class="text-xs {{ $errors->has('first_name') ? 'text-red-600 dark:text-red-400' : '' }}">نام
                    </label>
                <input type="text" class="form-input" name="first_name" id="first_name" value="{{ old('first_name') }}">
            </div>
            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="last_name"
                    class="text-xs {{ $errors->has('last_name') ? 'text-red-600 dark:text-red-400' : '' }}">نام
                    خانوادگی</label>
                <input type="text" class="form-input" name="last_name" id="last_name" value="{{ old('last_name') }}">
            </div>
            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="email"
                    class="text-xs {{ $errors->has('email') ? 'text-red-600 dark:text-red-400' : '' }}">ایمیل</label>
                <input type="email" class="form-input" name="email" id="email" value="{{ old('email') }}">
            </div>
            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="mobile"
                    class="text-xs {{ $errors->has('mobile') ? 'text-red-600 dark:text-red-400' : '' }}">موبایل</label>
                <input type="mobile" class="form-input" name="mobile" id="mobile" value="{{ old('mobile') }}">
            </div>
            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="password"
                    class="text-xs {{ $errors->has('password') ? 'text-red-600 dark:text-red-400' : '' }}">کلمه عبور</label>
                <input type="password" class="form-input" name="password" id="password" value="{{ old('password') }}">
            </div>
            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="password_confirmation"
                    class="text-xs {{ $errors->has('password_confirmation') ? 'text-red-600 dark:text-red-400' : '' }}">تکرار کلمه عبور</label>
                <input type="password" class="form-input" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}">
            </div>
            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="avatar"
                    class="text-xs {{ $errors->has('avatar') ? 'text-red-600 dark:text-red-400' : '' }}">آواتار</label>
                <input type="file" class="form-input" name="avatar" id="avatar" value="{{ old('avatar') }}">
            </div>

            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="activation"
                    class="text-xs {{ $errors->has('activation') ? 'text-red-600 dark:text-red-400' : '' }}">وضعیت کاربر</label>
                <select name="activation" id="activation" class="form-select" style="direction: ltr">
                    <option value="1" @if (old('activation') == 1) selected @endif>فعال</option>
                    <option value="0" @if (old('activation') == 0) selected @endif>غیرفعال</option>
                </select>

            </div>
            <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
        </section>
    </form>
</section>
@endsection
