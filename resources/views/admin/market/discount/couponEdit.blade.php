@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
    <title>پنل ادمین | بخش فروش | کوپن های تخفیف | ویرایش کوپن</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.market.discount.coupon') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">کوپن های تخفیف</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">ویرایش کوپن</span>

    </section>
@endsection
@section('content')

    <section class="flex flex-col gap-y-2 p-2 w-full">

        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">ویرایش کوپن</span>
            <a href="{{ route('admin.market.discount.coupon') }}" class="btn bg-blue-600 text-white">بازگشت</a>
        </div>

        @if ($errors->any())
            <div class="flex flex-col gap-y-1 rounded-lg bg-red-200 p-2">
                <span class="text-xs">خطا های فرم:</span>
                @foreach ($errors->all() as $error)
                    <div class="flex gap-x-1 text-red-600 items-center">
                        <span class="text-base">
                            <i class="fa-light fa-diamond-exclamation"></i>
                        </span>
                        <span class="text-sm">{{ $error }}</span>
                    </div>
                @endforeach

            </div>
        @endif


        <form class="w-full" action="{{ route('admin.market.discount.coupon.update', $discount->id) }}"
            method="POST" enctype="multipart/form-data" id="form">
            @csrf
            @method('put')
            <section class="w-full grid grid-cols-2 gap-2">
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="code"
                        class="text-xs {{ $errors->has('code') ? 'text-red-600 dark:text-red-400' : '' }}">کد
                        تخفیف</label>
                    <input type="text" class="form-input" name="code" id="code" value="{{ old('code', $discount->code) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="type"
                        class="text-xs {{ $errors->has('type') ? 'text-red-600 dark:text-red-400' : '' }}">نوع</label>
                    <select name="type" id="type" class="form-select" style="direction: ltr">
                        <option value="0" @if (old('type', $discount->type) == 0) selected @endif>عمومی</option>
                        <option value="1" @if (old('type', $discount->type) == 1) selected @endif>خصوصی</option>
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1  flex flex-col gap-y-1">
                    <label for="user_id"
                        class="text-xs {{ $errors->has('user_id') ? 'text-red-600 dark:text-red-400' : '' }}">انتخاب
                        کاربر</label>
                    <select name="user_id" id="user_id" class="form-select" style="direction: ltr">
                        <option value="">کاربر موردنظر را انتخاب کنید</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @if (old('user_id', $discount->user_id) == $user->id) selected @endif>
                                {{ $user->fullName . ' - ' . $user->id }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1  flex flex-col gap-y-1">
                    <label for="amount_type"
                        class="text-xs {{ $errors->has('amount_type') ? 'text-red-600 dark:text-red-400' : '' }}">نوع
                        مقدار
                        تخفیف</label>
                    <select name="amount_type" id="amount_type" class="form-select" style="direction: ltr">
                        <option value="0" @if (old('amount_type', $discount->amount_type) == 0) selected @endif>درصد</option>
                        <option value="1" @if (old('amount_type', $discount->amount_type) == 1) selected @endif>مبلغ</option>
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="amount"
                        class="text-xs {{ $errors->has('amount') ? 'text-red-600 dark:text-red-400' : '' }}">مقدار
                        تخفیف</label>
                    <input type="text" class="form-input" name="amount" id="amount" value="{{ old('amount', $discount->amount) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="maximum_discount"
                        class="text-xs {{ $errors->has('maximum_discount') ? 'text-red-600 dark:text-red-400' : '' }}">سقف
                        تخفیف</label>
                    <input type="text" class="form-input" name="maximum_discount" id="maximum_discount"
                        value="{{ old('maximum_discount', $discount->maximum_discount) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="valid_from"
                        class="text-xs {{ $errors->has('valid_from') ? 'text-red-600 dark:text-red-400' : '' }}">زمان
                        شروع
                        تخفیف</label>
                    <input type="hidden" name="valid_from" id="valid_from">
                    <input type="text" class="form-input" name="valid_from_view" id="valid_from_view" readonly>
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="valid_until"
                        class="text-xs {{ $errors->has('valid_until') ? 'text-red-600 dark:text-red-400' : '' }}">زمان
                        پایان
                        تخفیف</label>
                    <input type="hidden" name="valid_until" id="valid_until">
                    <input type="text" class="form-input" name="valid_until_view" id="valid_until_view" readonly>
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="status"
                        class="text-xs {{ $errors->has('status') ? 'text-red-600 dark:text-red-400' : '' }}">وضعیت</label>
                    <select name="status" id="status" class="form-select" style="direction: ltr">
                        <option value="1" @if (old('status', $discount->status) == 1) selected @endif>فعال</option>
                        <option value="0" @if (old('status', $discount->status) == 0) selected @endif>غیرفعال</option>
                    </select>
                </div>

                <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
            </section>
        </form>
    </section>
@endsection
@section('script')
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/jalali-persian-date-discounts.js') }}"></script>
@endsection
