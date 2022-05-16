@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | پرداخت ها</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li>کل پرداخت ها</li>


        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2 class="text-size-titr">کل پرداخت ها</h2>
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
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->user->fullName }}</td>
                    <td>{{ $payment->type() }}</td>
                @endforeach


            </tbody>
        </table>

    </div>
@endsection
