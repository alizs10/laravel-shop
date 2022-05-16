@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | تخفیف های شگفت انگیز</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li>تخفیف های شگفت انگیز</li>


        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>تخفیف های شگفت انگیز</h2>
            <a href="{{ route('admin.market.discount.amazing.create') }}" class="button button-info">ایجاد تخفیف شگفت انگیز
                جدید</a>

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
                    <td>کد کالا</td>
                    <td>نام کالا</td>
                    <td>میزان تخفیف</td>
                    <td>زمان شزوع تخفیف</td>
                    <td>زمان پایان تخفیف</td>
                    <td>وضعیت</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($discounts as $discount)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $discount->product_id }}</td>
                        <td>{{ $discount->product->name }}</td>
                        <td>{{ $discount->percentage }} %</td>
                        <td>{{ showPersianDate($discount->valid_from) }}</td>
                        <td>{{ showPersianDate($discount->valid_until) }}</td>
                        <td>{{ $discount->status == 0 ? 'غیرفعال' : 'فعال' }}</td>
                        <td>
                            <span>
                                <a href="{{ route('admin.market.discount.amazing.edit', $discount->id) }}"
                                    class="button button-warning">ویرایش</a>
                                <form action="{{ route('admin.market.discount.amazing.destroy', $discount->id) }}"
                                    method="POST">
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
