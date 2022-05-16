@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | روش های ارسال</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li>روش های ارسال</li>


        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2 class="text-size-titr">روش های ارسال</h2>
            <a href="{{ route('admin.market.delivery.create') }}" class="button button-info">ایجاد روش ارسال</a>

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
                    <td>نام روش ارسال</td>
                    <td>هزینه ارسال</td>
                    <td>زمان ارسال</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($deliveryMethods as $key => $delivery)

                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $delivery->name }}</td>
                        <td>{{ $delivery->amount . ' تومان' }}</td>
                        <td>{{ $delivery->delivery_time . ' ' . $delivery->delivery_time_unit }}</td>
                        <td>
                            <input type="checkbox" id="status-{{ $delivery->id }}"
                                data-url="{{ route('admin.market.delivery.status', $delivery->id) }}"
                                onchange="changeStatus({{ $delivery->id }})" @if ($delivery->status === 1)
                            checked
                @endif>
                </td>
                <td>
                    <span>
                        <a href="{{ route('admin.market.delivery.edit', $delivery->id) }}"
                            class="button button-warning">ویرایش</a>
                        <form action="{{ route('admin.market.delivery.destroy', $delivery->id) }}" method="POST">
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
