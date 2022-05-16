@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/selectize/css/selectize.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/selectize-correction.css') }}">
    <title>پنل ادمین | بخش محتوی | دسته بندی</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li class="text-primary">بخش محتوی</li>/
            <li><a class="text-primary" href="{{ route('admin.market.category.index') }}">دسته بندی</a></li>/
            <li>ایجاد دسته بندی جدید</li>

        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2>دسته بندی</h2>
            <a href="{{ route('admin.market.category.index') }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.market.category.store') }}" method="POST" enctype="multipart/form-data" id="form">
            @csrf
            <div class="flex-wrap flex-gap-2">
                <div class="form-input-half">
                    <label @if ($errors->has('name'))
                        class="text-danger"
                        @endif for="name">نام دسته</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('parent_id'))
                        class="text-danger"
                        @endif for="parent_id">دسته والد</label>
                    <select name="parent_id" id="parent_id">
                        <option value="">دسته اصلی</option>
                        @foreach ($productCategories as $cat)
                            <option value="{{ $cat->id }}" @if (old('parent_id') == $cat->id) selected @endif>
                            {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('show_in_menu'))
                        class="text-danger"
                        @endif for="show_in_menu">وضعیت نمایش در منو</label>
                    <select name="show_in_menu" id="show_in_menu">
                        <option value="1" @if (old('show_in_menu') == 1)
                            selected
                            @endif>فعال</option>
                        <option value="0" @if (old('show_in_menu') == 0)
                            selected
                            @endif>غیرفعال</option>
                    </select>
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

                <div class="form-input-full">
                    <label @if ($errors->has('image'))
                        class="text-danger"
                        @endif for="image">تصویر</label>
                    <input type="file" name="image" id="image">
                </div>

                <div class="form-input-full">
                    <label @if ($errors->has('tags'))
                        class="text-danger"
                        @endif for="input_tags">تگ ها</label>
                    <input class="w-100" type="text" name="tags" id="input_tags" value="{{ old('tags') }}">
                </div>


                <div class="form-input-full">
                    <label @if ($errors->has('description'))
                        class="text-danger"
                        @endif for="description">توضیحات</label>
                    <textarea name="description" rows="5" id="description">{{ old('description') }}</textarea>
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
