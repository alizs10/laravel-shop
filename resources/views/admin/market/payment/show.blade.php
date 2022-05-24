@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | پرداخت ها | مشاهده پرداخت</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.market.payment.all') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">پرداخت ها</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">مشاهده پرداخت</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">مشاهده پرداخت</span>
            <a href="{{ route('admin.market.payment.all') }}" class="btn bg-blue-600 text-white">بازگشت</a>
        </div>


        <div class="flex flex-col gap-y-1 text-sm">
            <h3>{{ $payment->user->fullName . ' - ' . $payment->user->id }}</h3>
            <p>مبلغ پرداخت شده: {{ $payment->amount }}</p>
            <p>درگاه: {{ $payment->gateway() }}</p>
            <p>نوع پرداخت: {{ $payment->type() }}</p>
            <p>وضعیت پرداخت: {{ $payment->status() }}</p>
            @if ($payment->type == 2)
                <p>تحویل گیرنده: {{ $payment->paymentable->cash_receiver }}</p>
                <p>تاریخ پرداخت: {{ showPersianDate($payment->paymentable->pay_date) }}</p>
            @endif
        </div>


    </section>
@endsection
@section('script')
    <script src="{{ asset('admin-assets/packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/js/ckreplace.js') }}"></script>
@endsection
