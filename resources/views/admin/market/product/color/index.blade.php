@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | رنگ های محصول</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.product.index') }}">محصولات</a></li>/
            <li>{{ $product->name }}</li>/
            <li>رنگ های محصول</li>


        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2 class="text-size-titr">رنگ های محصول <span class="text-danger">"{{ $product->name }}"</span></h2>
            <a href="{{ route('admin.market.product.color.create', $product->id) }}" class="button button-info">افزودن رنگ جدید</a>
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
                    <td>اسم رنگ</td>
                    <td>رنگ</td>
                    <td>کد رنگ</td>
                    <td>افزایش قیمت</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($product->colors as $key => $color)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $color->color_name }}</td>
                        <td>
                            <div class="rounded p-1" style="background-color: #{{ $color->color_code }}"></div>
                        </td>
                        <td>{{ '#'.$color->color_code }}</td>
                        <td>{{ $color->price_increase . ' تومان' }}</td>

                <td>
                    <span>
                        <a href="{{ route('admin.market.product.color.edit', $color->id) }}"
                            class="button button-warning">ویرایش</a>
                        <form action="{{ route('admin.market.product.color.destroy', $color->id) }}" method="POST">
                            @csrf
                            {{ method_field('delete') }}
                            <button type="submit" class="button button-danger delBtn">حذف</button>
                        </form>
                    </span>
                </td>

                </tr>

                @endforeach

            </tbody>
        </table>

    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
