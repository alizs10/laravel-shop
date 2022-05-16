@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش تیکت ها | ادمین ها</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="{{ route('admin.ticket.index') }}">بخش تیکت ها</a></li>/
            <li>ادمین ها</li>


        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ادمین ها</h2>
            <a href="{{ route('admin.ticket.admin.all') }}" class="button button-info">افزودن ادمین جدید به لیست</a>
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
                    <td>نام</td>
                    <td>ایمیل</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($admins as $key => $admin)

                    <tr>
                        <td @if ($key += 1 % 2 !== 0)
                            class="active-row"
                @endif>{{ $key }}</td>
                <td>{{ $admin->user->fullName }}</td>
                <td>{{ $admin->user->email }}</td>

                <td>
                    <form action="{{ route('admin.ticket.admin.destroy', $admin->id) }}" method="POST">
                        @csrf
                        {{ method_field('delete') }}
                        <button type="submit" class="button button-danger delBtn">حذف از لیست</button>
                    </form>
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
