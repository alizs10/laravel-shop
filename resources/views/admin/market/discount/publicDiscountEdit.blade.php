@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
    <title>پنل ادمین | بخش فروش | ویرایش تخفیف عمومی</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.market.discount.public') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">تخفیف های عمومی</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">ویرایش تخفیف عمومی</span>

    </section>
@endsection
@section('content')

    <section class="flex flex-col gap-y-2 p-2 w-full">

        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">ویرایش تخفیف عمومی</span>
            <a href="{{ route('admin.market.discount.public') }}" class="btn bg-blue-600 text-white">بازگشت</a>
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


        <form class="w-full" action="{{ route('admin.market.discount.public.update', $discount->id) }}"
            method="POST" enctype="multipart/form-data" id="form">
            @csrf
            @method('put')
            <section class="w-full grid grid-cols-2 gap-2">
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="title"
                        class="text-xs {{ $errors->has('title') ? 'text-red-600 dark:text-red-400' : '' }}">عنوان کد
                        تخفیف</label>
                    <input type="text" class="form-input" name="title" id="title" value="{{ old('title', $discount->title) }}">
                </div>

                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="percentage"
                        class="text-xs {{ $errors->has('percentage') ? 'text-red-600 dark:text-red-400' : '' }}">مقدار
                        تخفیف</label>
                    <input type="text" class="form-input" name="percentage" id="percentage"
                        value="{{ old('percentage', $discount->percentage) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="maximum_discount"
                        class="text-xs {{ $errors->has('maximum_discount') ? 'text-red-600 dark:text-red-400' : '' }}">سقف
                        تخفیف</label>
                    <input type="text" class="form-input" name="maximum_discount" id="maximum_discount"
                        value="{{ old('maximum_discount', $discount->maximum_discount) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="minimum_order_amount"
                        class="text-xs {{ $errors->has('minimum_order_amount') ? 'text-red-600 dark:text-red-400' : '' }}">حداقل
                        مبلغ سفارش</label>
                    <input type="text" class="form-input" name="minimum_order_amount" id="minimum_order_amount"
                        value="{{ old('minimum_order_amount', $discount->minimum_order_amount) }}">
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
