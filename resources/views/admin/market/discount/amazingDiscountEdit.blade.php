@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
    <title>پنل ادمین | بخش فروش | ویرایش تخفیف شگفت انگیز</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="#">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.discount.amazing') }}">تخفیف های شگفت انگیز</a>
            </li>/
            <li>ویرایش تخفیف شگفت انگیز</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ویرایش تخفیف شگفت انگیز</h2>
            <a href="{{ route('admin.market.discount.amazing') }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.market.discount.amazing.update', $discount->id) }}" method="POST" id="form">
            @csrf
            @method('put')
            <div class="flex-wrap flex-gap-2">
                <div class="form-input-half">
                    <label @if ($errors->has('product_id')) class="text-danger" @endif for="product_id">انتخاب
                        محصول</label>
                    <select name="product_id" id="product_id">
                        <option value="">محصول موردنظر را انتخاب کنید</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" @if (old('product_id', $discount->product_id) == $product->id) selected @endif>
                                {{ $product->name . ' - ' . $product->id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('percentage')) class="text-danger" @endif for="percentage">میزان تخفیف</label>
                    <input type="text" name="percentage" id="percentage"
                        value="{{ old('percentage', $discount->percentage) }}">
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

                <div class="form-input-full">
                    <label @if ($errors->has('status')) class="text-danger" @endif for="status">وضعیت</label>
                    <select name="status" id="status">
                        <option value="1" @if (old('status', $discount->status) == 1) selected @endif>فعال</option>
                        <option value="0" @if (old('status', $discount->status) == 0) selected @endif>غیرفعال</option>
                    </select>
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
