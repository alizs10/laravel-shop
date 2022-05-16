@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | ادمین ها</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li>ادمین ها</li>


        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ادمین های سایت</h2>
            <a href="{{ route('admin.ticket.admin.index') }}" class="button button-info">بازگشت</a>
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
                <td>{{ $admin->fullName }}</td>
                <td>{{ $admin->email }}</td>

                <td>
                    <span>
                        <button data-url="{{ route('admin.ticket.admin.set', $admin->id) }}"
                            onclick="changeTicketAdmin({{ $admin->id }})" id="admin-{{ $admin->id }}"
                            class="button button-{{ $admin->ticketAdmin ? 'danger' : 'success' }}">
                            @if ($admin->ticketAdmin)
                                حذف وظیفه
                            @else
                                اعمال وظیفه
                            @endif
                        </button>

                    </span>
                </td>

                </tr>

                @endforeach



            </tbody>
        </table>

    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-ticket-admin.js') }}"></script>
@endsection
