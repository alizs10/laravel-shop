@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | ایجاد پیج</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش محتوی</a></li>/
            <li><a class="text-primary" href="{{ route('admin.content.page.index') }}">پیچ ساز</a></li>/
            <li>ایجاد پیج</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ایجاد پیج</h2>
            <a href="{{ route('admin.content.page.index') }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.content.page.store') }}" method="POST" id="form">
            @csrf
            <div class="row-head">
                <div class="form-input-half">
                    <label @if ($errors->has('title'))
                        class="text-danger"
                        @endif for="question">عنوان صفحه</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}">
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
                    <label @if ($errors->has('tags'))
                        class="text-danger"
                        @endif for="input_tags">تگ ها</label>
                    <input type="hidden" name="tags" id="input_tags" value="{{ old('tags') }}">
                    <select id="select_tags" multiple>

                    </select>
                </div>





                <div class="form-input-full">
                    <label @if ($errors->has('body'))
                        class="text-danger"
                        @endif for="cke">محتوای صفحه</label>
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
    <script src="{{ asset('admin-assets/js/select2tags.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/js/ckreplace.js') }}"></script>

@endsection
