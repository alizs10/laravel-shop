@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | مشاهده پرداخت</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="#">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.payment.all') }}">پرداخت ها</a></li>/
            <li>مشاهده پرداخت</li>

        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2>مشاهده پرداخت</h2>
            <a href="{{ route('admin.market.payment.all') }}" class="button button-info">بازگشت</a>
        </div>

        <div class="flex-column flex-row-gap-2">

            <h3>{{ $payment->user->fullName . ' - ' . $payment->user->id }}</h3>

            <div class="w-100 bg-g-green rounded">
                <p class="m-space">مبلغ پرداخت شده: {{ $payment->amount }}</p>
                <p class="m-space">درگاه: {{ $payment->gateway() }}</p>
                <p class="m-space">نوع پرداخت: {{ $payment->type() }}</p>
                <p class="m-space">وضعیت پرداخت: {{ $payment->status() }}</p>
                @if ($payment->type == 2)
                    <p class="m-space">تحویل گیرنده: {{ $payment->paymentable->cash_receiver }}</p>
                    <p class="m-space">تاریخ پرداخت: {{ showPersianDate($payment->paymentable->pay_date) }}</p>
                @endif
            </div>

        </div>






    </div>
@endsection
@section('script')
    <script src="{{ asset('admin-assets/packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/js/ckreplace.js') }}"></script>
@endsection
