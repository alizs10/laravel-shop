@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/selectize/css/selectize.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/selectize-correction.css') }}">
    <title>پنل ادمین | بخش فروش | محصولات | ایجاد محصول جدید</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.market.product.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">محصولات</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">ایجاد محصول جدید</span>

    </section>
@endsection
@section('content')

    <section class="flex flex-col gap-y-2 p-2 w-full">

        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">ایجاد محصول جدید</span>
            <a href="{{ route('admin.market.product.index') }}" class="btn bg-blue-600 text-white">بازگشت</a>
        </div>

        @if ($errors->any())
            <div class="flex flex-col gap-y-1 rounded-lg bg-red-200 p-2">
                <span class="text-xs">خطا های فرم:</span>
                @foreach ($errors->all() as $error)
                    <div class="flex gap-x-1 text-red-600 items-center">
                        <span class="text-base">
                            <i class="fa-light fa-diamond-exclamation"></i>
                        </span>
                        <span class="text-sm">{{ $error }}</span>
                    </div>
                @endforeach

            </div>
        @endif


        <form class="w-full" action="{{ route('admin.market.product.store') }}" method="POST"
            enctype="multipart/form-data" id="form">
            @csrf

            <section class="w-full grid grid-cols-2 gap-2">
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="name"
                        class="text-xs {{ $errors->has('name') ? 'text-red-600 dark:text-red-400' : '' }}">نام
                        محصول</label>
                    <input type="text" class="form-input" name="name" id="name" value="{{ old('name') }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="image"
                        class="text-xs {{ $errors->has('image') ? 'text-red-600 dark:text-red-400' : '' }}">تصویر</label>
                    <input type="file" class="form-input" name="image" id="image">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="weight"
                        class="text-xs {{ $errors->has('weight') ? 'text-red-600 dark:text-red-400' : '' }}">وزن</label>
                    <input type="text" class="form-input" name="weight" id="weight" value="{{ old('weight') }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="height"
                        class="text-xs {{ $errors->has('height') ? 'text-red-600 dark:text-red-400' : '' }}">ارتفاع</label>
                    <input type="text" class="form-input" name="height" id="height" value="{{ old('height') }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="width"
                        class="text-xs {{ $errors->has('width') ? 'text-red-600 dark:text-red-400' : '' }}">عرض</label>
                    <input type="text" class="form-input" name="width" id="width" value="{{ old('width') }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="length"
                        class="text-xs {{ $errors->has('length') ? 'text-red-600 dark:text-red-400' : '' }}">طول</label>
                    <input type="text" class="form-input" name="length" id="length" value="{{ old('length') }}">
                </div>

                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="cat_id"
                        class="text-xs {{ $errors->has('cat_id') ? 'text-red-600 dark:text-red-400' : '' }}">دسته</label>
                    <select name="cat_id" id="cat_id" class="form-select" style="direction: ltr">
                        <option value="">دسته را انتخاب کنید</option>
                        @foreach ($productCategories as $cat)
                            <option value="{{ $cat->id }}" @if (old('cat_id') == $cat->id) selected @endif>
                                {{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="brand_id"
                        class="text-xs {{ $errors->has('brand_id') ? 'text-red-600 dark:text-red-400' : '' }}">برند</label>
                    <select name="brand_id" id="brand_id" class="form-select" style="direction: ltr">
                        <option value="">برند را انتخاب کنید</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" @if (old('brand_id') == $brand->id) selected @endif>
                                {{ $brand->original_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="status"
                        class="text-xs {{ $errors->has('status') ? 'text-red-600 dark:text-red-400' : '' }}">وضعیت</label>
                    <select name="status" id="status" class="form-select" style="direction: ltr">
                        <option value="0" @if (old('status') == 0) selected @endif>غیرفعال</option>
                        <option value="1" @if (old('status') == 1) selected @endif>فعال</option>
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="marketable"
                        class="text-xs {{ $errors->has('marketable') ? 'text-red-600 dark:text-red-400' : '' }}">قابل
                        فروش بودن</label>
                    <select name="marketable" id="marketable" class="form-select" style="direction: ltr">
                        <option value="0" @if (old('marketable') == 0) selected @endif>غیرفعال</option>
                        <option value="1" @if (old('marketable') == 1) selected @endif>فعال</option>
                    </select>
                </div>

                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="price"
                        class="text-xs {{ $errors->has('price') ? 'text-red-600 dark:text-red-400' : '' }}">قیمت</label>
                    <input type="text" class="form-input" name="price" id="price" value="{{ old('price') }}">
                </div>

                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="published_at"
                        class="text-xs {{ $errors->has('published_at') ? 'text-red-600 dark:text-red-400' : '' }}">تاریخ
                        انتشار
                    </label>
                    <input type="hidden" name="published_at" id="published_at">
                    <input type="text" class="form-input" name="published_at_view" id="published_at_view" readonly>
                </div>

                <div class="col-span-2  flex flex-col gap-y-1">
                    <label for="tags"
                        class="text-xs {{ $errors->has('tags') ? 'text-red-600 dark:text-red-400' : '' }}">تگ ها</label>
                    <input type="text" name="tags" id="input_tags" value="{{ old('tags') }}">

                </div>

                <div class="col-span-2 flex flex-col gap-y-1">
                    <label for="introduction"
                        class="text-xs {{ $errors->has('introduction') ? 'text-red-600 dark:text-red-400' : '' }}">توضیحات</label>
                    <textarea type="text" class="form-input" name="introduction" id="cke">{{ old('introduction') }}</textarea>
                </div>

                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-2">
                    
                    <div class="grid grid-cols-2 gap-x-2" id="meta_fields">
                        <div class="col-span-1">
                            <input class="form-input w-full" type="text" name="meta_key[]" placeholder="ویژگی ...">
                        </div>
                        <div class="col-span-1">
                            <input class="form-input w-full" type="text" name="meta_value[]" placeholder="مقدار ...">
                        </div>
                    </div>

                    <button type="button" class="btn bg-blue-600" onclick="addMetaField()">افزودن ویژگی</button>
                </div>

                <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
            </section>
        </form>
    </section>

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
