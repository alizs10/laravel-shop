@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | مقادیر فرم کالا</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.property.index') }}">فرم کالا</a></li>/
            <li>{{ $property->name }}</li>/
            <li>مقادیر فرم کالا</li>


        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2 class="text-size-titr">مقادیر فرم کالا <span class="text-danger">"{{ $property->name }}"</span></h2>
            <a href="{{ route('admin.market.property.value.create', $property->id) }}" class="button button-info">افزودن مقدار جدید</a>
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
                    <td>نام محصول</td>
                    <td>فرم کالا</td>
                    <td>مقدار</td>
                    <td>افزایش قیمت</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($property->values as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value->product->name }}</td>
                        <td>{{ $value->attribute->name }}</td>
                        <td>{{ json_decode($value->value)->value }}</td>
                        
                        <td>{{ json_decode($value->value)->price_increase . ' تومان' }}</td>

                <td>
                    <span>
                        <a href="{{ route('admin.market.property.value.edit', $value->id) }}"
                            class="button button-warning">ویرایش</a>
                        <form action="{{ route('admin.market.property.value.destroy', $value->id) }}" method="POST">
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
