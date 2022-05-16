@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/selectize/css/selectize.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/selectize-correction.css') }}">
    <title>پنل ادمین | بخش فروش | ایجاد برند جدید</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.brand.index') }}">برند ها</a></li>/
            <li>ایجاد برند جدید</li>

        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2>ایجاد برند جدید</h2>
            <a href="{{ route('admin.market.brand.index') }}" class="button button-info">بازگشت</a>
        </div>

        @if ($errors->any())
        <div class="row-head bg-danger py-1 rounded">
            <ul class="flex-column flex-row-gap-1">
                @foreach ($errors->all() as $error)
                    <li class="text-white text-size-1 mr-space">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form action="{{ route('admin.market.brand.store') }}" method="POST" enctype="multipart/form-data" id="form">
            @csrf
            <div class="flex-wrap flex-gap-2">
                <div class="form-input-half">
                    <label @if ($errors->has('persian_name'))
                        class="text-danger"
                        @endif for="persian_name">نام برند (فارسی)</label>
                    <input type="text" name="persian_name" id="persian_name" value="{{ old('persian_name') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('original_name'))
                        class="text-danger"
                        @endif for="original_name">نام برند (انگلیسی)</label>
                    <input type="text" name="original_name" id="original_name" value="{{ old('original_name') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('status'))
                        class="text-danger"
                        @endif for="status">وضعیت</label>
                    <select name="status" id="status">
                        <option value="1" @if (old('status') == 1)
                            selected
                            @endif>فعال</option>
                        <option value="0" @if (old('status') == 0)
                            selected
                            @endif>غیرفعال</option>
                    </select>
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('logo'))
                        class="text-danger"
                        @endif for="logo">تصویر</label>
                    <input type="file" name="logo" id="logo">
                </div>

                <div class="form-input-full">
                    <label @if ($errors->has('tags'))
                        class="text-danger"
                        @endif for="input_tags">تگ ها</label>
                    <input class="w-100" type="text" name="tags" id="input_tags" value="{{ old('tags') }}">
                </div>

                <div class="row-head w-100">
                    <button type="submit" class="button button-success w-100">افزودن</button>
                </div>

            </div>

        </form>



    </div>
@endsection
@section('script')
    <script src="{{ asset('admin-assets/packages/selectize/js/selectize.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/select-tags.js') }}"></script>

@endsection
