@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/selectize/css/selectize.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/selectize-correction.css') }}">
    <title>پنل ادمین | بخش فروش | ایجاد محصول جدید</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.product.index') }}">محصولات</a></li>/
            <li>ایجاد محصول جدید</li>

        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2>ایجاد محصول جدید</h2>
            <a href="{{ route('admin.market.product.index') }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.market.product.store') }}" method="POST" enctype="multipart/form-data" id="form">
            @csrf
            <div class="flex-wrap flex-gap-2">
                <div class="form-input-half">
                    <label @if ($errors->has('name'))
                        class="text-danger"
                        @endif for="name">نام محصول</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('image'))
                        class="text-danger"
                        @endif for="image">تصویر محصول</label>
                    <input type="file" name="image" id="image" value="{{ old('image') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('weight'))
                        class="text-danger"
                        @endif for="weight">وزن</label>
                    <input type="text" name="weight" id="weight" value="{{ old('weight') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('height'))
                        class="text-danger"
                        @endif for="height">ارتفاع</label>
                    <input type="text" name="height" id="height" value="{{ old('height') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('width'))
                        class="text-danger"
                        @endif for="width">عرض</label>
                    <input type="text" name="width" id="width" value="{{ old('width') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('length'))
                        class="text-danger"
                        @endif for="length">طول</label>
                    <input type="text" name="length" id="length" value="{{ old('length') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('cat_id'))
                        class="text-danger"
                        @endif for="cat_id">دسته</label>
                    <select name="cat_id" id="cat_id">
                        <option value="">دسته را انتخاب کنید</option>
                        @foreach ($productCategories as $cat)
                            <option value="{{ $cat->id }}" @if (old('cat_id') == $cat->id) selected @endif>{{ $cat->name }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('brand_id'))
                        class="text-danger"
                        @endif for="brand_id">برند ها</label>
                    <select name="brand_id" id="brand_id">
                        <option value="">برند را انتخاب کنید</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" @if (old('brand_id') == $brand->id) selected @endif>{{ $brand->original_name }}
                            </option>
                        @endforeach

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

                <div class="form-input-half">
                    <label @if ($errors->has('marketable'))
                        class="text-danger"
                        @endif for="marketable">قابل فروش بودن</label>
                    <select name="marketable" id="marketable">
                        <option value="1" @if (old('marketable') == 1)
                            selected
                            @endif>فعال</option>
                        <option value="0" @if (old('marketable') == 0)
                            selected
                            @endif>غیرفعال</option>
                    </select>
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('price'))
                        class="text-danger"
                        @endif for="price">قیمت</label>
                    <input type="text" name="price" id="price" value="{{ old('price') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('published_at'))
                        class="text-danger"
                        @endif for="published_at">تاریخ انتشار</label>
                    <input type="hidden" name="published_at" id="published_at">
                    <input type="text" id="published_at_view">
                </div>

                <div class="form-input-full">
                    <label @if ($errors->has('tags'))
                        class="text-danger"
                        @endif for="input_tags">تگ ها</label>
                    <input class="w-100" type="text" name="tags" id="input_tags" value="{{ old('tags') }}">
                </div>


                <div class="form-input-full">
                    <label @if ($errors->has('introduction'))
                        class="text-danger"
                        @endif for="cke">توضیحات</label>
                    <textarea name="introduction" id="cke" rows="6">{{ old('introduction') }}</textarea>
                </div>

                <div class="flex-column flex-row-gap-1 text-white w-100">

                    <div class="flex-wrap flex-gap-2" id="meta_fields">
                        <div class="form-input-half">
                            <input type="text" name="meta_key[]" placeholder="ویژگی ...">
                        </div>
    
                        <div class="form-input-half">
                            <input type="text" name="meta_value[]" placeholder="مقدار ...">
                        </div>
                    </div>

                    <button type="button" class="button button-primary" onclick="addMetaField()">افزودن ویژگی</button>
                </div>

                <div class="row-head w-100">
                    <button type="submit" class="button button-success w-100">ثبت محصول</button>
                </div>

            </div>
        </form>






    </div>
@endsection

@section('script')
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/jalali-persian-date.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/selectize/js/selectize.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/select-tags.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/js/ckreplace.js') }}"></script>
    <script>
        
        let addMetaField = () => {
            var meta_fields = $('#meta_fields').clone()
            $('#meta_fields').before(meta_fields)
        }

    </script>

@endsection
