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

        <div class="flex-wrap flex-gap-2">
            <div class="form-input-half">
                <label for="">نام تحویل گیرنده</label>
                <input type="text" name="" id="" value="{{ old('') }}">
            </div>
            <div class="form-input-half">
                <label for="">نام تحویل دهنده</label>
                <input type="text" name="" id="" value="{{ old('') }}">
            </div>

            <div class="form-input-half">
                <label for="">تعداد</label>
                <input type="text" name="" id="" value="{{ old('') }}">
            </div>


            <div class="form-input-full">
                <label for="">توضیحات</label>
                <textarea name="" rows="5">{{ old('') }}</textarea>
            </div>


        </div>


        <div class="row-head">
            <a class="button button-primary">ثبت</a>
        </div>


        

    </div>
@endsection
