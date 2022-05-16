@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | کوپن جدید</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="#">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.delivery.index') }}">کوپن های تخفیف</a></li>/
            <li>ایجاد کوپن جدید</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ایجاد کوپن جدید</h2>
            <a href="{{ route('admin.market.discount.coupon') }}" class="button button-info">بازگشت</a>
        </div>

        <div class="row-head">
            <div class="form-input">
                <label for="">کد کوپن</label>
                <input type="text">
            </div>

            <div class="form-input">
                <label for="">میزان تخفیف</label>
                <input type="text">
            </div>

            <div class="form-input">
                <label for="">سقف تخفیف</label>
                <input type="text">
            </div>
            
            <div class="form-input">
                <label for="">زمان شروع تخفیف</label>
                <input type="text">
            </div>

            <div class="form-input">
                <label for="">زمان پایان تخفیف</label>
                <input type="text">
            </div>

        </div>


        <div class="row-head">
            <a class="button button-success">افزودن</a>
        </div>




    </div>
@endsection
