@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | انبار</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li>انبار</li>


        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2 class="text-size-titr">انبار</h2>
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
                    <td>نام کالا</td>
                    <td>تصویر کالا</td>
                    <td>موجودی</td>
                    <td>ورودی انبار</td>
                    <td>خروجی انبار</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>۱</td>
                    <td>گوشی آیفون 12</td>
                    <td><img src="{{ asset('admin-assets/images/vector.jpg') }}" class="max-height-3rem"></td>
                    <td>10</td>
                    <td>40</td>
                    <td>30</td>
                    <td class="w-20">
                        <span>
                            <a href="{{ route('admin.market.store.add-to-store') }}" class="button button-primary">افزایش موجودی</a>
                            <a href="{{ route('admin.market.store.edit') }}" class="button button-warning">اصلاح موجودی</a>
                        </span>
                    </td>
                </tr>

            </tbody>
        </table>

    </div>
@endsection
