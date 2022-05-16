@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | افزایش موجودی انبار</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.store.index') }}">انبار</a></li>/
            <li>افزایش موجودی انبار</li>

        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2>افزایش موجودی انبار</h2>
            <a href="{{ route('admin.market.store.index') }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.market.store.store', $product->id) }}" method="POST" id="form">
            @csrf
            <div class="flex-wrap flex-gap-2">
                <div class="form-input-half">
                    <label for="receiver">نام تحویل گیرنده</label>
                    <input type="text" name="receiver" id="receiver" value="{{ old('receiver') }}">
                </div>
                <div class="form-input-half">
                    <label for="deliverer">نام تحویل دهنده</label>
                    <input type="text" name="deliverer" id="deliverer" value="{{ old('deliverer') }}">
                </div>

                <div class="form-input-half">
                    <label for="marketable_number">تعداد</label>
                    <input type="text" name="marketable_number" id="marketable_number"
                        value="{{ old('marketable_number') }}">
                </div>


                <div class="form-input-full">
                    <label for="description">توضیحات</label>
                    <textarea name="description" id="description" rows="5">{{ old('description') }}</textarea>
                </div>


            </div>


            <div class="row-head">
                <button type="submit" class="button button-primary">ثبت</button>
            </div>
        </form>



    </div>
@endsection
