@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | برند ها</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li>برند</li>


        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2 class="text-size-titr">برند ها</h2>
            <a href="{{ route('admin.market.brand.create') }}" class="button button-info">افزودن برند جدید</a>
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
                    <td>نام برند</td>
                    <td>لوگو</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>


                @foreach ($brands as $key => $brand)

                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $brand->persian_name }}</td>
                        <td>
                            <img src="{{ asset('storage\\' . $brand->logo['indexArray']['small']) }}" alt="">
                        </td>
                        <td>
                            <input type="checkbox" id="status-{{ $brand->id }}"
                                data-url="{{ route('admin.market.brand.status', $brand->id) }}"
                                onchange="changeStatus({{ $brand->id }})" @if ($brand->status === 1)
                            checked
                @endif>
                </td>
                <td>
                    <span>
                        <a href="{{ route('admin.market.brand.edit', $brand->id) }}"
                            class="button button-warning">ویرایش</a>
                        <form action="{{ route('admin.market.brand.destroy', $brand->id) }}" method="POST">
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
