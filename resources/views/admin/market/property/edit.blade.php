@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | ویرایش فرم کالا</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.property.index') }}">فرم کالا</a></li>/
            <li>ویرایش فرم کالا</li>

        </ol>
    </div>



    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2>ویرایش فرم کالا</h2>
            <a href="{{ route('admin.market.property.index') }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.market.property.update', $property->id) }}" method="POST" id="form">
            @csrf
            @method('put')
            <div class="flex-wrap flex-gap-2">
                <div class="form-input-half">
                    <label @if ($errors->has('name'))
                        class="text-danger"
                        @endif for="name">عنوان فرم کالا</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $property->name) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('unit'))
                        class="text-danger"
                        @endif for="unit">واحد فرم کالا</label>
                    <input type="text" name="unit" id="unit" value="{{ old('unit', $property->unit) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('type'))
                        class="text-danger"
                        @endif for="type">نوع فرم کالا</label>
                    <select name="type" id="type">
                        <option value="0" @if (old('type', $property->type) == 0) selected @endif>ساده</option>
                        <option value="1" @if (old('type', $property->type) == 1) selected @endif>انتخابی</option>
                    </select>
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('cat_id'))
                        class="text-danger"
                        @endif for="cat_id">دسته</label>
                    <select name="cat_id" id="cat_id">
                        <option value="">دسته را انتخاب کنید</option>
                        @foreach ($productCategories as $cat)
                            <option value="{{ $cat->id }}" @if (old('cat_id', $property->cat_id) == $cat->id) selected @endif>{{ $cat->name }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="row-head w-100">
                    <button type="submit" class="button button-warning w-100">ویرایش</button>
                </div>
            </div>
        </form>




    </div>
@endsection
