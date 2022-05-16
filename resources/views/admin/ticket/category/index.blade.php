@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش تیکت ها | دسته بندی</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="{{ route('admin.ticket.index') }}">بخش تیکت ها</a></li>/
            <li>دسته بندی</li>


        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>دسته بندی</h2>
            <a href="{{ route('admin.ticket.category.create') }}" class="button button-info">افزودن دسته بندی جدید</a>
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
                    <td>وضعیت</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($categories as $key => $category)

                    <tr>
                        <td @if ($key += 1 % 2 !== 0)
                            class="active-row"
                @endif>{{ $key }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <input type="checkbox" id="status-{{ $category->id }}"
                        data-url="{{ route('admin.ticket.category.status', $category->id) }}"
                        onchange="changeStatus({{ $category->id }})" @if ($category->status === 1)
                    checked
                    @endif>
                </td>
                <td>
                    <span>
                        <a href="{{ route('admin.ticket.category.edit', $category->id) }}"
                            class="button button-warning">ویرایش</a>
                        <form action="{{ route('admin.ticket.category.destroy', $category->id) }}" method="POST">
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