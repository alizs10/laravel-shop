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
                    <td>قابل فروش</td>
                    <td>در سبد خرید</td>
                    <td>فروخته شده</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td><img src="{{ asset('storage\\' . $product->image["indexArray"][$product->image["currentImage"]]) }}" class="max-height-3rem"></td>
                        <td>{{ $product->marketable_number }}</td>
                        <td>{{ $product->frozen_number }}</td>
                        <td>{{ $product->sold_number }}</td>
                        <td class="w-20">
                            <span>
                                <a href="{{ route('admin.market.store.add-to-store', $product->id) }}"
                                    class="button button-primary">افزایش موجودی</a>
                                <a href="{{ route('admin.market.store.edit', $product->id) }}" class="button button-warning">اصلاح
                                    موجودی</a>
                            </span>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
@endsection
