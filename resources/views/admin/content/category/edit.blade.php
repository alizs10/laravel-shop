@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | ویرایش دسته بندی</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li class="text-primary">بخش محتوی</li>/
            <li><a class="text-primary" href="{{ route('admin.content.category.index') }}">دسته بندی</a></li>/
            <li>ویرایش دسته بندی</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ویرایش دسته بندی</h2>
            <a href="{{ route('admin.content.category.index') }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.content.category.update', $postCategory->id) }}" method="POST"
            enctype="multipart/form-data" id="form">
            @csrf
            {{ method_field('put') }}
            <div class="row-head">
                <div class="form-input">
                    <label @if ($errors->has('name'))
                        class="text-danger"
                        @endif for="name">نام دسته</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $postCategory->name) }}">
                </div>

                <div class="form-input">
                    <label @if ($errors->has('tags'))
                        class="text-danger"
                        @endif for="input_tags">تگ ها</label>
                    <input type="hidden" name="tags" id="input_tags" value="{{ old('tags', $postCategory->tags) }}">
                    <select id="select_tags" multiple>

                    </select>
                </div>

                <div class="form-input">
                    <label @if ($errors->has('image'))
                        class="text-danger"
                        @endif for="image">تصویر</label>
                    <input type="file" name="image" id="image">

                </div>

                <div class="form-input">
                    <label for="currentImage">تصویر پیش فرض</label>
                    <select name="currentImage">
                        @foreach ($postCategory->image['indexArray'] as $key => $value)
                            <option value="{{ $key }}" @if ($key === $postCategory->image['currentImage']) selected @endif>

                                @switch($key)
                                    @case('larger')
                                        {{ 'بزرگ' }}
                                    @break
                                    @case('medium')
                                        {{ 'متوسط' }}
                                    @break

                                    @case('small')
                                        {{ 'کوچک' }}
                                    @break
                                    @default

                                @endswitch

                            </option>
                        @endforeach
                    </select>
                 
                </div>
            
                <div class="form-input">
                    <label @if ($errors->has('status'))
                        class="text-danger"
                        @endif for="status">وضعیت</label>
                    <select name="status" id="status">
                        <option value="1" @if (old('status', $postCategory->status) == 1)
                            selected
                            @endif>فعال</option>
                        <option value="0" @if (old('status', $postCategory->status) == 0)
                            selected
                            @endif>غیرفعال</option>
                    </select>
                </div>

                <div class="form-input">
                    <label @if ($errors->has('description'))
                        class="text-danger"
                        @endif for="description">توضیحات</label>
                    <textarea name="description"
                        id="description">{{ old('description', $postCategory->description) }}</textarea>
                </div>

            </div>

            <div class="row-head">
                <button type="submit" class="button button-warning">ویرایش</button>
            </div>
        </form>





    </div>
@endsection

@section('script')
    <script src="{{ asset('admin-assets/js/select2tags.js') }}"></script>

@endsection
