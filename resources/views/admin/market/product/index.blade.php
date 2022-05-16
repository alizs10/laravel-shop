@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | محصولات</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li>محصولات</li>


        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2 class="text-size-titr">محصولات</h2>
            <a href="{{ route('admin.market.product.create') }}" class="button button-info">افزودن محصول جدید</a>
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
                    <td>قیمت</td>
                    <td>دسته</td>
                    <td>تاریخ انتشار</td>
                    <td>وضعیت</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $key => $product)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            <img src="{{ asset('storage\\' . $product->image['indexArray']['small']) }}" alt="">
                        </td>
                        <td>{{ $product->price . ' تومان' }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ showPersianDate($product->published_at, 'Y-m-d') }}</td>
                        <td>
                            <input type="checkbox" id="status-{{ $product->id }}"
                                data-url="{{ route('admin.market.product.status', $product->id) }}"
                                onchange="changeStatus({{ $product->id }})" @if ($product->status === 1)
                            checked
                @endif>
                </td>
                <td>
                    <span>

                        <a href="{{ route('admin.market.product.color.index', $product->id) }}"
                            class="button button-primary">رنگ ها ({{ count($product->colors) }})</a>

                        <a href="{{ route('admin.market.product.gallery.index', $product->id) }}"
                            class="button button-success">گالری ({{ count($product->gallery) }})</a>
                        <a href="{{ route('admin.market.product.edit', $product->id) }}"
                            class="button button-warning">ویرایش</a>
                        <form action="{{ route('admin.market.product.destroy', $product->id) }}" method="POST">
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-status.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
