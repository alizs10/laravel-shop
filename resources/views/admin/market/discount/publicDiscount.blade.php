@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | تخفیف های عمومی</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li>تخفیف های عمومی</li>


        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>تخفیف های عمومی</h2>
            <a href="{{ route('admin.market.discount.publicDiscount.create') }}" class="button button-info">ایجاد تخفیف عمومی جدید</a>

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
                    <td>کد تخفیف</td>
                    <td>میزان تخفیف</td>
                    <td>سقف تخفیف</td>
                    <td>زمان شزوع تخفیف</td>
                    <td>زمان پایان تخفیف</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>norooz</td>
                    <td>25%</td>
                    <td>30000 تومان</td>
                    <td>1 فروردین 1401</td>
                    <td>13 فروردین 1401</td>
                    <td>
                        <span>
                            <a href="" class="button button-warning">ویرایش</a>
                            <button type="submit" class="button button-danger">حذف</button>
                        </span>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>norooz</td>
                    <td>25%</td>
                    <td>30000 تومان</td>
                    <td>1 فروردین 1401</td>
                    <td>13 فروردین 1401</td>
                    <td>
                        <span>
                            <a href="" class="button button-warning">ویرایش</a>
                            <button type="submit" class="button button-danger">حذف</button>
                        </span>
                    </td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>norooz</td>
                    <td>25%</td>
                    <td>30000 تومان</td>
                    <td>1 فروردین 1401</td>
                    <td>13 فروردین 1401</td>
                    <td>
                        <span>
                            <a href="" class="button button-warning">ویرایش</a>
                            <button type="submit" class="button button-danger">حذف</button>
                        </span>
                    </td>
                </tr>


            </tbody>
        </table>

    </div>
@endsection
