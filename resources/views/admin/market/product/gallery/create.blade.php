@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | ایجاد رنگ جدید</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.product.index') }}">محصولات</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.product.color.index', $product->id) }}">{{ $product->name }}</a></li>/
            <li>ایجاد رنگ جدید</li>

        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2>ایجاد رنگ جدید</h2>
            <a href="{{ route('admin.market.product.color.index', $product->id) }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.market.product.color.store', $product->id) }}" method="POST" id="form">
            @csrf
            <div class="flex-wrap flex-gap-2">
                <div class="form-input-half">
                    <label @if ($errors->has('color_name'))
                        class="text-danger"
                        @endif for="color_name">نام رنگ</label>
                    <input type="text" name="color_name" id="color_name" value="{{ old('color_name') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('price_increase'))
                        class="text-danger"
                        @endif for="price_increase">افزایش قیمت</label>
                    <input type="text" name="price_increase" id="price_increase" value="{{ old('price_increase') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('color_code'))
                        class="text-danger"
                        @endif for="color_code">کد رنگ</label>
                    <input type="text" name="color_code" id="v" value="{{ old('color_code') }}">
                </div>


                <div class="row-head w-100">
                    <button type="submit" class="button button-success w-100">ثبت رنگ</button>
                </div>

            </div>
        </form>






    </div>
@endsection
