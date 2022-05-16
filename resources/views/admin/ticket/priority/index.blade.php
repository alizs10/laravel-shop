@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش تیکت ها | اولویت بندی</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="{{ route('admin.ticket.index') }}">بخش تیکت ها</a></li>/
            <li>اولویت بندی</li>


        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>اولویت بندی</h2>
            <a href="{{ route('admin.ticket.priority.create') }}" class="button button-info">افزودن اولویت بندی جدید</a>
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
                    <td>عنوان</td>
                    <td>وضعیت</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($priorities as $key => $priority)

                    <tr>
                        <td @if ($key += 1 % 2 !== 0)
                            class="active-row"
                @endif>{{ $key }}</td>
                <td>{{ $priority->name }}</td>
                <td>
                    <input type="checkbox" id="status-{{ $priority->id }}"
                        data-url="{{ route('admin.ticket.priority.status', $priority->id) }}"
                        onchange="changeStatus({{ $priority->id }})" @if ($priority->status === 1)
                    checked
                    @endif>
                </td>
                <td>
                    <span>
                        <a href="{{ route('admin.ticket.priority.edit', $priority->id) }}"
                            class="button button-warning">ویرایش</a>
                        <form action="{{ route('admin.ticket.priority.destroy', $priority->id) }}" method="POST">
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