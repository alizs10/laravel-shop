@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | مشاهده فاکتور</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li>مشاهده فاکتور</li>


        </ol>
    </div>

    <div class="box-container flex flex-column gap-y-2">
        <div class="row-head">
            <h2>مشاهده فاکتور</h2>

            <button class="button button-primary" onClick="print('print')">
                <i class="fa fa-print ml-space"></i>
                چاپ</button>
            <script type="text/javascript" src="{{ asset('admin-assets/js/print.js') }}"></script>
        </div>


        <section class="bg-white rounded p-space" id="print">
            <table>
                <thead>
                    <tr>
                        مشخصات فروشنده
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>نام شرکت: فروشگاه لاراول</td>
                        <td>شماره اقتصادی: 135468431</td>
                        <td>شماره شناسه ملی: 0002165</td>
                    </tr>
                    <tr>
                        <td>نام استان: تهران</td>
                        <td>شهرستان: تهران</td>
                        <td>شماره ثبت: 7865</td>
                        <td>کد پستی: 64789456325</td>

                    </tr>
                    <tr>
                        <td>نشانی: شهرک صنغتی دوم، میدان اول، خیابان دوم شرقی</td>
                        <td>شماره تماس: 021-45687920</td>

                    </tr>
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        مشخصات خریدار
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>نام و نام خانوادگی: {{ $order->user->fullName }}</td>
                        <td>شماره شناسه نامه: 135468431</td>
                    </tr>
                    <tr>
                        <td>نام استان: {{ $order->address->city->province->name }}</td>
                        <td>شهرستان: {{ $order->address->city->name }}</td>
                        <td>نشانی: {{ $order->address->address }}</td>
                    </tr>
                    <tr>
                        <td>پلاک: {{ $order->address->no ?? '-' }}</td>
                        <td>واحد: {{ $order->address->unit ?? '-' }}</td>
                        <td>کد پستی: {{ $order->address->postal_code }}</td>
                        <td>شماره تماس: {{ $order->address->mobile }}</td>
                    </tr>
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>کد کالا</th>
                        <th>نام کالا</th>
                        <th>تعداد/مقدار</th>
                        <th>مبلغ واحد(تومان)</th>
                        <th>مبلغ تخفیف</th>
                        <th>مبلغ کل پس از تخفیف</th>
                        <th>مالیات</th>
                        <th>عوارض</th>
                        <th>هزینه نهایی</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</tdd>
                            <td>{{ $item->product_id }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->number }}</td>
                            <td>{{ $item->final_product_price }}</td>
                            <td>{{ '-' }}</td>
                            <td>{{ $item->final_product_price }}</td>
                            <td>{{ 0 }}</td>
                            <td>{{ 0 }}</td>
                            <td>{{ $item->final_total_price }}</td>
                        </tr>
                    @endforeach




                </tbody>
            </table>
            <p>
                مبلغ قابل پرداخت : {{ $order->order_final_amount - $order->order_total_products_discount_amount }} تومان
            </p>
        </section>

    </div>
@endsection
