@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | {{ $page }}</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li>{{ $page }}</li>


        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2 class="text-size-titr">{{ $page }}</h2>
        </div>


        <div class="row-head">
            <select name="" id="">
                <option value="10">10</option>
                <option value="100">100</option>
                <option value="1000">1000</option>
            </select>
            <div class="searchBox">
                <a><i class="fas fa-search"></i></a>
                <input type="text">
            </div>
        </div>

        <table class="styled-table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>کد تراکنش</td>
                    <td>بانک</td>
                    <td>مبلغ پرداختی</td>
                    <td>پرداخت کننده</td>
                    <td>وضعیت پرداخت</td>
                    <td>شیوه پرداخت</td>
                    <td class="w-30">عملیات</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $payment->transactionId() }}</td>
                        <td>{{ $payment->gateway() }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->user->fullName }}</td>
                        <td>{{ $payment->status() }}</td>
                        <td>{{ $payment->type() }}</td>
                        <td class="w-20">
                            <span>
                                <a href="{{ route('admin.market.payment.show', $payment->id) }}"
                                    class="button button-primary">
                                    <i class="fa-solid fa-eye ml-space"></i>
                                    مشاهده</a>
                                <a href="{{ route('admin.market.payment.cancel', $payment->id) }}"
                                    class="button button-warning">
                                    <i class="fa-solid fa-xmark ml-space"></i>
                                    لغو کردن</a>
                                <a href="{{ route('admin.market.payment.refund', $payment->id) }}"
                                    class="button button-danger">
                                    <i class="fa-solid fa-share ml-space"></i>
                                    برگشت وجه</a>
                            </span>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>

    </div>
@endsection
