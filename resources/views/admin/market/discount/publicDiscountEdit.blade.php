@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
    <title>پنل ادمین | بخش فروش | ویرایش تخفیف عمومی</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="#">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.discount.public') }}">تخفیف های عمومی</a>
            </li>/
            <li>ویرایش تخفیف عمومی</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ویرایش تخفیف عمومی</h2>
            <a href="{{ route('admin.market.discount.public') }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.market.discount.public.update', $discount->id) }}" method="POST"
            enctype="multipart/form-data" id="form">
            @csrf
            @method('put')
            <div class="flex-wrap flex-gap-2">
                <div class="form-input-half">
                    <label @if ($errors->has('title')) class="text-danger" @endif for="title">عنوان کد تخفیف</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $discount->title) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('percentage')) class="text-danger" @endif for="percentage">میزان تخفیف</label>
                    <input type="text" name="percentage" id="percentage"
                        value="{{ old('percentage', $discount->percentage) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('maximum_discount')) class="text-danger" @endif for="maximum_discount">سقف
                        تخفیف</label>
                    <input type="text" name="maximum_discount" id="maximum_discount"
                        value="{{ old('maximum_discount', $discount->maximum_discount) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('minimum_order_amount')) class="text-danger" @endif for="minimum_order_amount">حداقل
                        مبلغ سفارش</label>
                    <input type="text" name="minimum_order_amount" id="minimum_order_amount"
                        value="{{ old('minimum_order_amount', $discount->minimum_order_amount) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('valid_from')) class="text-danger" @endif for="valid_from">زمان شروع
                        تخفیف</label>
                    <input type="hidden" name="valid_from" id="valid_from"
                        value="{{ old('valid_from', $discount->valid_from) }}">
                    <input type="text" id="valid_from_view" />
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('valid_until')) class="text-danger" @endif for="valid_until">زمان پایان
                        تخفیف</label>
                    <input type="hidden" name="valid_until" id="valid_until"
                        value="{{ old('valid_until', $discount->valid_until) }}">
                    <input type="text" id="valid_until_view" />
                </div>

                <div class="row-head w-100">
                    <button type="submit" class="button button-success w-100">ثبت</button>
                </div>

            </div>
        </form>

    </div>
@endsection
@section('script')
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/jalali-persian-date-discounts.js') }}"></script>
@endsection
