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

    <div class="box-container">
        <div class="row-head">
            <h2>{{ $page }}</h2>
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
                    <td>کد سفارش</td>
                    <td>مبلغ سفارش (بدون تخفیف)</td>
                    <td>مبلغ کل تخفیف</td>
                    <td>مبلغ نهایی</td>
                    <td>وضعیت پرداخت</td>
                    <td>شیوه پرداخت</td>
                    <td>بانک</td>
                    <td>شیوه ارسال</td>
                    <td>وضعیت ارسال</td>
                    <td>وضعیت سفارش</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->order_final_amount }} هزارتومان</td>
                        <td>{{ $order->order_total_products_discount_amount }} هزار تومان</td>
                        <td>{{ $order->order_final_amount - $order->order_total_products_discount_amount }} هزارتومان</td>
                        <td>{{ $order->payment->status }}</td>
                        <td>{{ $order->payment->type }}</td>
                        <td>{{ $order->payment->paymentable->gateway }}</td>
                        <td>{{ $order->delivery->name }}</td>
                        <td>{{ $order->deliveryStatus() }}</td>
                        <td>{{ $order->status() }}</td>
                        <td>
                            <div class="dropdown-area">
                                <button class="button dropdown-toggle-btn" id="toggle-dropdown-{{ $order->id }}"
                                    onclick="toggleDropdown('dropdown-{{ $order->id }}')">
                                    عملیات
                                    <i class="fa-regular fa-angle-down mr-space"></i>
                                </button>
                                <div class="sub-btns hidden" id={{ "dropdown-{$order->id}" }}>
                                    <button class="button dropdown-btn">
                                        <i class="fa-regular fa-eye ml-space text-primary"></i>
                                        مشاهده فاکتور</button>
                                    <a href="{{ route('admin.market.order.change-delivery-status', $order->id) }}"
                                        class="button dropdown-btn">
                                        <i class="fa-light fa-truck ml-space text-success"></i>
                                        تغییر وضعیت ارسال</a>
                                    <a href="{{ route('admin.market.order.change-status', $order->id) }}"
                                        class="button dropdown-btn">
                                        <i class="fa-light fa-rectangle-list ml-space"></i>
                                        تغییر وضعیت سفارش</a>
                                    <form action="{{ route('admin.market.order.destroy', $order->id) }}"
                                        method="POST">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button class="button dropdown-btn delBtn">
                                            <i class="fa-regular fa-trash-can ml-space text-danger"></i>
                                            حذف</button>
                                    </form>

                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach



            </tbody>
        </table>

    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/dropdown-btn.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
