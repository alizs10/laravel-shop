@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | ویرایش مقدار</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.property.index') }}">محصولات</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.property.value.index', $value->category_attribute_id) }}">{{ $value->attribute->name }}</a></li>/
            <li>ویرایش مقدار</li>

        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2>ویرایش مقدار</h2>
            <a href="{{ route('admin.market.property.value.index', $value->category_attribute_id) }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.market.property.value.update', $value->id) }}" method="POST" id="form">
            @csrf
            @method('put')
            <div class="flex-wrap flex-gap-2">

                <div class="form-input-half">
                    <label @if ($errors->has('product_id'))
                        class="text-danger"
                        @endif for="product_id">محصول</label>
                    <select name="product_id" id="product_id">
                        <option value="">محصول را انتخاب کنید</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" @if (old('product_id', $value->product_id) == $product->id) selected @endif>{{ $product->name }}</option>
                        @endforeach

                    </select>
                </div>


                <div class="form-input-half">
                    <label @if ($errors->has('value'))
                        class="text-danger"
                        @endif for="value">مقدار</label>
                    <input type="text" name="value" id="value" value="{{ old('value', json_decode($value->value)->value) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('price_increase'))
                        class="text-danger"
                        @endif for="price_increase">افزایش قیمت</label>
                    <input type="text" name="price_increase" id="price_increase" value="{{ old('price_increase', json_decode($value->value)->price_increase) }}">
                </div>

              


                <div class="row-head w-100">
                    <button type="submit" class="button button-warning w-100">ویرایش مقدار</button>
                </div>

            </div>
        </form>






    </div>
@endsection
