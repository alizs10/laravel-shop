@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/selectize/css/selectize.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/selectize-correction.css') }}">
    <title>پنل ادمین | بخش فروش | ویرایش محصول</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.product.index') }}">محصولات</a></li>/
            <li>ویرایش محصول</li>

        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2>ویرایش محصول</h2>
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

        <form action="{{ route('admin.market.product.update', $product->id) }}" method="POST"
            enctype="multipart/form-data" id="form">
            @csrf
            @method('put')
            <div class="flex-wrap flex-gap-2">
                <div class="form-input-half">
                    <label @if ($errors->has('name'))
                        class="text-danger"
                        @endif for="name">نام محصول</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('image'))
                        class="text-danger"
                        @endif for="image">تصویر محصول</label>
                    <input type="file" name="image" id="image">
                </div>

                <div class="form-input-half">
                    <label for="currentImage">تصویر پیش فرض</label>
                    <select name="currentImage">
                        @foreach ($product->image['indexArray'] as $key => $value)
                            <option value="{{ $key }}" @if (old('currentImage', $key) == $product->image['currentImage']) selected @endif>

                                @switch($key)
                                    @case('larger')
                                        بزرگ
                                    @break
                                    @case('medium')
                                        متوسط
                                    @break

                                    @case('small')
                                        کوچک
                                    @break
                                    @default

                                @endswitch

                            </option>
                        @endforeach
                    </select>

                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('weight'))
                        class="text-danger"
                        @endif for="weight">وزن</label>
                    <input type="text" name="weight" id="weight" value="{{ old('weight', $product->weight) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('height'))
                        class="text-danger"
                        @endif for="height">ارتفاع</label>
                    <input type="text" name="height" id="height" value="{{ old('height', $product->height) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('width'))
                        class="text-danger"
                        @endif for="width">عرض</label>
                    <input type="text" name="width" id="width" value="{{ old('width', $product->width) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('length'))
                        class="text-danger"
                        @endif for="length">طول</label>
                    <input type="text" name="length" id="length" value="{{ old('length', $product->length) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('cat_id'))
                        class="text-danger"
                        @endif for="cat_id">دسته</label>
                    <select name="cat_id" id="cat_id">
                        <option value="">دسته را انتخاب کنید</option>
                        @foreach ($productCategories as $cat)
                            <option value="{{ $cat->id }}" @if (old('cat_id', $product->cat_id) == $cat->id) selected @endif>{{ $cat->name }}</option>
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
                            <option value="{{ $brand->id }}" @if (old('brand_id', $product->brand_id) == $brand->id) selected @endif>{{ $brand->original_name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('status'))
                        class="text-danger"
                        @endif for="status">وضعیت</label>
                    <select name="status" id="status">
                        <option value="1" @if (old('status', $product->status) == 1)
                            selected
                            @endif>فعال</option>
                        <option value="0" @if (old('status', $product->status) == 0)
                            selected
                            @endif>غیرفعال</option>
                    </select>
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('marketable'))
                        class="text-danger"
                        @endif for="marketable">قابل فروش بودن</label>
                    <select name="marketable" id="marketable">
                        <option value="1" @if (old('marketable', $product->marketable) == 1)
                            selected
                            @endif>فعال</option>
                        <option value="0" @if (old('marketable', $product->marketable) == 0)
                            selected
                            @endif>غیرفعال</option>
                    </select>
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('price'))
                        class="text-danger"
                        @endif for="price">قیمت</label>
                    <input type="text" name="price" id="price" value="{{ old('price', $product->price) }}">
                </div>

                <div class="form-input-full">
                    <label @if ($errors->has('published_at'))
                        class="text-danger"
                        @endif for="published_at">تاریخ انتشار</label>
                    <input type="hidden" name="published_at" id="published_at"
                        value="{{ old('published_at', $product->published_at) }}">
                    <input type="text" id="published_at_view" value="{{ old('published_at', $product->published_at) }}">
                </div>

                <div class="form-input-full">
                    <label @if ($errors->has('tags'))
                        class="text-danger"
                        @endif for="input_tags">تگ ها</label>
                    <input class="w-100" type="text" name="tags" id="input_tags"
                        value="{{ old('tags', $product->tags) }}">
                </div>


                <div class="form-input-full">
                    <label @if ($errors->has('introduction'))
                        class="text-danger"
                        @endif for="cke">توضیحات</label>
                    <textarea name="introduction" id="cke" rows="6">{{ old('introduction', $product->introduction) }}</textarea>
                </div>

                <div class="flex-column flex-row-gap-1 text-white">



                    @foreach ($product->metas as $key => $meta)
                        <div class="flex-wrap flex-gap-2 meta_fields">
                            <div class="form-input">
                                <input type="text" name="meta_key[]" placeholder="ویژگی ..."
                                    value="{{ old('meta_key.'.$key, $meta->meta_key) }}">
                            </div>

                            <div class="form-input">
                                <input type="text" name="meta_value[]" placeholder="مقدار ..."
                                    value="{{ old('meta_value.'.$key, $meta->meta_value) }}">
                            </div>

                            <button type="button" class="button button-danger" onclick="deleteMetaField(this)">حذف</button>
                        </div>
                    @endforeach




                    <button type="button" class="button button-primary" onclick="addMetaField()">افزودن ویژگی</button>
                </div>

                <div class="row-head w-100">
                    <button type="submit" class="button button-warning w-100">ویرایش محصول</button>
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
            var meta_fields = $('.meta_fields:last-of-type').clone()
            $('.meta_fields:last-of-type').before(meta_fields)
        }

        let deleteMetaField = (x) => {
            var meta_row = $(x).parent()
            meta_row.remove()
        }
    </script>

@endsection
