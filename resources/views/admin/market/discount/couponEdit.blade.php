@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
    <title>پنل ادمین | بخش فروش | ویرایش کوپن</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="#">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.discount.coupon') }}">کوپن های تخفیف</a></li>/
            <li>ایجاد ویرایش کوپن</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ایجاد ویرایش کوپن</h2>
            <a href="{{ route('admin.market.discount.coupon') }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.market.discount.coupon.update', $discount->id) }}" method="POST" id="form">
            @csrf
            @method('put')
            <div class="flex-wrap flex-gap-2">

                <div class="form-input-half">
                    <label @if ($errors->has('code')) class="text-danger" @endif for="code">کد تخفیف</label>
                    <input type="text" name="code" id="code" value="{{ old('code', $discount->code) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('type')) class="text-danger" @endif for="type">نوع تخفیف</label>
                    <select name="type" id="type">
                        <option value="0" @if (old('type', $discount->type) == 0) selected @endif>عمومی</option>
                        <option value="1" @if (old('type', $discount->type) == 1) selected @endif>خصوصی</option>
                    </select>
                </div>


                <div class="form-input-half">
                    <label @if ($errors->has('user_id')) class="text-danger" @endif for="user_id">انتخاب
                        کاربر</label>
                    <select name="user_id" id="user_id">
                        <option value="">کاربر موردنظر را انتخاب کنید</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @if (old('user_id', $discount->user_id) == $user->id) selected @endif>
                                {{ $user->fullName . ' - ' . $user->id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('amount_type')) class="text-danger" @endif for="amount_type">نوع مقدار
                        تخفیف</label>
                    <select name="amount_type" id="amount_type">
                        <option value="0" @if (old('amount_type', $discount->amount_type) == 0) selected @endif>درصد</option>
                        <option value="1" @if (old('amount_type', $discount->amount_type) == 1) selected @endif>هزینه</option>
                    </select>
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('amount')) class="text-danger" @endif for="amount">مقدار تخفیف</label>
                    <input type="text" name="amount" id="amount" value="{{ old('amount', $discount->amount) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('maximum_discount')) class="text-danger" @endif for="maximum_discount">سقف
                        تخفیف</label>
                    <input type="text" name="maximum_discount" id="maximum_discount"
                        value="{{ old('maximum_discount', $discount->maximum_discount) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('valid_from')) class="text-danger" @endif for="valid_from">زمان شروع
                        تخفیف</label>
                    <input type="hidden" name="valid_from" id="valid_from" value="{{ old('valid_from', $discount->valid_from) }}">
                    <input type="text" id="valid_from_view" />
                </div>
                
                <div class="form-input-half">
                    <label @if ($errors->has('valid_until')) class="text-danger" @endif for="valid_until">زمان پایان
                        تخفیف</label>
                    <input type="hidden" name="valid_until" id="valid_until" value="{{ old('valid_until', $discount->valid_until) }}">
                    <input type="text" id="valid_until_view" />
                </div>

                <div class="form-input-full">
                    <label @if ($errors->has('status')) class="text-danger" @endif for="status">وضعیت</label>
                    <select name="status" id="status">
                        <option value="0" @if (old('status', $discount->status) == 0) selected @endif>غیرفعال</option>
                        <option value="1" @if (old('status', $discount->status) == 1) selected @endif>فعال</option>
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
