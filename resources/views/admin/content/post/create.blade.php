@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | ایجاد پست جدید</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-white">بخش محتوی</a></li>/
            <li><a class="text-primary" href="{{ route('admin.content.post.index') }}">پست ها</a></li>/
            <li>ایجاد پست جدید</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ایجاد پست جدید</h2>
            <a href="{{ route('admin.content.post.index') }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.content.post.store') }}" method="POST" enctype="multipart/form-data" id="form">
            @csrf
            <div class="row-head">
                <div class="form-input">
                    <label @if ($errors->has('title'))
                        class="text-danger"
                    @endif for="title">عنوان پست</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}">
                </div>

                <div class="form-input">
                    <label @if ($errors->has('summary'))
                        class="text-danger"
                    @endif for="summary">خلاصه</label>
                    <input type="text" name="summary" id="summary" value="{{ old('summary') }}">
                </div>

                <div class="form-input">
                    <label @if ($errors->has('image'))
                        class="text-danger"
                    @endif for="image">تصویر</label>
                    <input type="file" name="image" id="image">
                </div>

                <div class="form-input">
                    <label @if ($errors->has('cat_id'))
                        class="text-danger"
                    @endif for="cat_id">دسته</label>
                    <select name="cat_id" id="cat_id">
                        <option value="">یک دسته را انتخاب کنید</option>
                        @foreach ($postCategories as $cat)
                            <option value="{{ $cat->id }}" @if ($cat->id == old('cat_id')) selected @endif>{{ $cat->name }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-input">
                    <label @if ($errors->has('tags'))
                        class="text-danger"
                        @endif for="input_tags">تگ ها</label>
                    <input type="hidden" name="tags" id="input_tags" value="{{ old('tags') }}">
                    <select id="select_tags" multiple>

                    </select>
                </div>

                <div class="form-input">
                    <label @if ($errors->has('published_at'))
                        class="text-danger"
                    @endif for="published_at">تاریخ انتشار</label>
                    <input type="hidden" name="published_at" id="published_at">
                    <input type="text" id="published_at_view">
                </div>

                <div class="form-input">
                    <label @if ($errors->has('commentable'))
                        class="text-danger"
                        @endif for="commentable">نظرات برای این پست</label>
                    <select name="commentable" id="commentable">
                        <option value="1" @if (old('commentable') == 1)
                            selected
                            @endif>فعال</option>
                        <option value="0" @if (old('commentable') == 0)
                            selected
                            @endif>غیرفعال</option>
                    </select>
                </div>

                <div class="form-input">
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
                    <label @if ($errors->has('body'))
                        class="text-danger"
                    @endif for="body">متن</label>
                    <textarea name="body" id="cke" rows="6">{{ old('body') }}</textarea>
                </div>


            </div>
            <div class="row-head">
                <button type="submit" class="button button-primary">ثبت</button>
            </div>
        </form>

        




    </div>
@endsection

@section('script')
    <script src="{{ asset('admin-assets/packages/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/select2tags.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/js/ckreplace.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/jalali-persian-date.js') }}"></script>

@endsection
