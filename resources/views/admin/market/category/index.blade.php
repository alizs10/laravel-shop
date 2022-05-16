@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | دسته بندی</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li>بخش محتوی</li>/
            <li>دسته بندی</li>


        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2 class="text-size-titr">دسته بندی</h2>
            <a href="{{ route('admin.market.category.create') }}" class="button button-info">افزودن دسته بندی جدید</a>
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
                    <td>شناسه</td>
                    <td>نام دسته</td>
                    <td>دسته والد</td>
                    <td>تصویر</td>
                    <td>تگ ها</td>
                    <td>وضعیت</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($productCategories as $key => $productCategory)

                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $productCategory->name }}</td>
                        <td>{{ $productCategory->parent->name ?? 'دسته اصلی' }}</td>
                        <td>
                            <img src="{{ asset('storage\\'.$productCategory->image['indexArray']['small']) }}" alt="">
                        </td>
                        <td>{{ $productCategory->tags }}</td>
                        <td>
                            <input type="checkbox" id="status-{{ $productCategory->id }}"
                                data-url="{{ route('admin.market.category.status', $productCategory->id) }}"
                                onchange="changeStatus({{ $productCategory->id }})" @if ($productCategory->status === 1)
                            checked
                @endif>
                </td>
                <td>
                    <span>
                        <a href="{{ route('admin.market.category.edit', $productCategory->id) }}"
                            class="button button-warning">ویرایش</a>
                        <form action="{{ route('admin.market.category.destroy', $productCategory->id) }}" method="POST">
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
