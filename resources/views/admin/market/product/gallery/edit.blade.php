@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | ویرایش رنگ</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.product.index') }}">محصولات</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.product.color.index', $color->product_id) }}">{{ $color->product->name }}</a></li>/
            <li>ویرایش رنگ</li>

        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2>ویرایش رنگ</h2>
            <a href="{{ route('admin.market.product.color.index', $color->product_id) }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.market.product.color.update', $color->id) }}" method="POST" id="form">
            @csrf
            @method('put')
            <div class="flex-wrap flex-gap-2">
                <div class="form-input-half">
                    <label @if ($errors->has('color_name'))
                        class="text-danger"
                        @endif for="color_name">نام رنگ</label>
                    <input type="text" name="color_name" id="color_name" value="{{ old('color_name', $color->color_name) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('price_increase'))
                        class="text-danger"
                        @endif for="price_increase">افزایش قیمت</label>
                    <input type="text" name="price_increase" id="price_increase" value="{{ old('price_increase', $color->price_increase) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('color_code'))
                        class="text-danger"
                        @endif for="color_code">کد رنگ</label>
                    <input type="text" name="color_code" id="v" value="{{ old('color_code', $color->color_code) }}">
                </div>


                <div class="row-head w-100">
                    <button type="submit" class="button button-warning w-100">ویرایش رنگ</button>
                </div>

            </div>
        </form>






    </div>
@endsection
