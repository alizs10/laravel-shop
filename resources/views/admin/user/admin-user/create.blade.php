@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | ادمین جدید</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش کاربران</a></li>/
            <li><a class="text-primary" href="{{ route('admin.user.admin-user.index') }}">ادمین ها</a></li>/
            <li>ایجاد ادمین جدید</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ادمین جدید</h2>
            <a href="{{ route('admin.user.admin-user.index') }}" class="button button-info">بازگشت</a>
        </div>
        @if ($errors->any())
            <div class="row-head bg-danger rounded">
                <ul class="flex-column flex-row-gap-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-white text-size-1 mr-space">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.user.admin-user.store') }}" method="POST" enctype="multipart/form-data" id="form">
            @csrf
            <div class="row-head">
                <div class="form-input-half">
                    <label @if ($errors->has('first_name'))
                        class="text-danger"
                        @endif for="first_name">نام</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('last_name'))
                        class="text-danger"
                        @endif for="last_name">نام خانوادگی</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('email'))
                        class="text-danger"
                        @endif for="email">ایمیل</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('first_name'))
                        class="text-danger"
                        @endif for="mobile">شماره موبایل</label>
                    <input type="number" name="mobile" id="mobile" value="{{ old('mobile') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('first_name'))
                        class="text-danger"
                        @endif for="password">کلمه عبور</label>
                    <input type="password" name="password" id="password">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('first_name'))
                        class="text-danger"
                        @endif for="password_confirmation">تکرار کلمه عبور</label>
                    <input type="password" name="password_confirmation" id="password_confirmation">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('avatar'))
                        class="text-danger"
                        @endif for="avatar">آواتار</label>
                    <input type="file" name="avatar" id="avatar">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('activation'))
                        class="text-danger"
                        @endif for="activation">وضعیت کاربر</label>
                    <select name="activation" id="status">
                        <option value="1" @if (old('activation') == 1)
                            selected
                            @endif>فعال</option>
                        <option value="0" @if (old('activation') == 0)
                            selected
                            @endif>غیرفعال</option>
                    </select>
                </div>


            </div>
            <div class="row-head">
                <button type="submit" class="button button-primary">ثبت</button>
            </div>
        </form>


    </div>
@endsection
