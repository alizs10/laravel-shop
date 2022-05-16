@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | سفارشات</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li>کل سفارشات</li>


        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>کل سفارشات</h2>
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
                    <td>مبلغ سفارش</td>
                    <td>مبلغ تخفیف</td>
                    <td>مبلغ نهایی</td>
                    <td>وضعیت پرداخت</td>
                    <td>شیوه پرداخت</td>
                    <td>بانک</td>
                    <td>شیوه ارسال</td>
                    <td>وضعیت سفارش</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>45487654</td>
                    <td>450,000 هزارتومان</td>
                    <td>30,000 هزار  تومان</td>
                    <td>420,000 هزارتومان</td>
                    <td>پرداخت شده</td>
                    <td>آنلاین</td>
                    <td>ملت</td>
                    <td>پست پیشتاز</td>
                    <td>در حال ارسال</td>
                    <td>
                        <span>
                            <button type="submit" class="button button-primary">عملیات</button>
                        </span>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>45487654</td>
                    <td>450,000 هزارتومان</td>
                    <td>30,000 هزار  تومان</td>
                    <td>420,000 هزارتومان</td>
                    <td>پرداخت شده</td>
                    <td>آنلاین</td>
                    <td>ملت</td>
                    <td>پست پیشتاز</td>
                    <td>در حال ارسال</td>
                    <td>
                        <span>
                            <button type="submit" class="button button-primary">عملیات</button>
                        </span>
                    </td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>45487654</td>
                    <td>450,000 هزارتومان</td>
                    <td>30,000 هزار  تومان</td>
                    <td>420,000 هزارتومان</td>
                    <td>پرداخت شده</td>
                    <td>آنلاین</td>
                    <td>ملت</td>
                    <td>پست پیشتاز</td>
                    <td>در حال ارسال</td>
                    <td>
                        <span>
                            <button type="submit" class="button button-primary">عملیات</button>
                        </span>
                    </td>
                </tr>


            </tbody>
        </table>

    </div>
@endsection
