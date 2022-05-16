@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل مشتری | بخش کاربران | ویرایش اطلاعات مشتری</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش کاربران</a></li>/
            <li><a class="text-primary" href="{{ route('admin.user.customer.index') }}">مشتریان</a></li>/
            <li>ویرایش اطلاعات مشتری</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ویرایش اطلاعات مشتری</h2>
            <a href="{{ route('admin.user.customer.index') }}" class="button button-info">بازگشت</a>
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
        <form action="{{ route('admin.user.customer.update', $user->id) }}" method="POST" enctype="multipart/form-data"
            id="form">
            @csrf
            @method('put')
            <div class="row-head">
                <div class="form-input-half">
                    <label @if ($errors->has('first_name'))
                        class="text-danger"
                        @endif for="first_name">نام</label>
                    <input type="text" name="first_name" id="first_name"
                        value="{{ old('first_name', $user->first_name) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('last_name'))
                        class="text-danger"
                        @endif for="last_name">نام خانوادگی</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('national_code'))
                        class="text-danger"
                        @endif for="national_code">کد ملی</label>
                    <input type="text" name="national_code" id="national_code" value="{{ old('national_code', $user->national_code) }}">
                </div>



                <div class="form-input-full">
                    <label @if ($errors->has('avatar'))
                        class="text-danger"
                        @endif for="avatar">آواتار</label>
                    <input type="file" name="avatar" id="avatar">
                </div>




            </div>
            <div class="row-head">
                <button type="submit" class="button button-primary">ثبت</button>
            </div>
        </form>


    </div>
@endsection
