@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | ویرایش تنظیمات</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="{{ route('admin.setting.index') }}">تنظیمات</a></li>/
            <li>ویرایش تنظیمات</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ویرایش تنظیمات</h2>
            <a href="{{ route('admin.setting.index') }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data" id="form">
            @csrf
            {{ method_field('put') }}
            <div class="row-head">
                <div class="form-input-full">
                    <label @if ($errors->has('title'))
                        class="text-danger"
                        @endif for="title">عنوان سایت</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $setting->title) }}">
                </div>

                <div class="form-input-full">
                    <label @if ($errors->has('description'))
                        class="text-danger"
                        @endif for="description">توضیحات سایت</label>
                    <input type="text" name="description" id="description" value="{{ old('description', $setting->description) }}">
                </div>

                <div class="form-input-full">
                    <label @if ($errors->has('keywords'))
                        class="text-danger"
                        @endif for="keywords">کلمات کلیدی سایت</label>
                    <input type="text" name="keywords" id="keywords" value="{{ old('keywords', $setting->keywords) }}">
                </div>

                
                <div class="form-input-half">
                    <label @if ($errors->has('logo'))
                        class="text-danger"
                        @endif for="logo">لوگو سایت</label>
                    <input type="file" name="logo" id="logo">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('icon'))
                        class="text-danger"
                        @endif for="icon">آیکون سایت</label>
                    <input type="file" name="icon" id="icon">
                </div>


            </div>
            <div class="row-head">
                <button type="submit" class="button button-primary">ثبت</button>
            </div>
        </form>






    </div>
@endsection
