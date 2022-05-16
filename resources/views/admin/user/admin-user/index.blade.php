@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | ادمین ها</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش کاربران</a></li>/
            <li>ادمین ها</li>


        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ادمین ها</h2>
            <a href="{{ route('admin.user.admin-user.create') }}" class="button button-info">افزودن ادمین جدید</a>
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
                    <td>شماره موبایل</td>
                    <td>نقش ها</td>
                    <td>وضعیت کاربر</td>
                    <td>وضعیت</td>
                    <td class="w-20">عملیات</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($admins as $key => $admin)
                    <tr>
                        <td @if (($key + 1) % 2) !== 0)
                            class="active-row"
                @endif>{{ $key + 1 }}</td>
                <td>{{ $admin->fullName }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->mobile }}</td>
                <td class="flex-column">
                
                    @if (sizeof($admin->roles) !== 0) 

                        @foreach ($admin->roles as $num => $role)

                            <div>
                                {{ $num + 1 . '- ' . $role->name }}
                            </div>

                        @endforeach
                    @else
                        <p class="text-danger">بدون نقش</p>
                    @endif
                </td>
                <td>
                    <input type="checkbox" id="activation-{{ $admin->id }}"
                        data-url="{{ route('admin.user.admin-user.activation', $admin->id) }}"
                        onchange="changeActivation({{ $admin->id }})" @if ($admin->activation === 1)
                    checked
                    @endif>
                </td>
                <td>
                    <input type="checkbox" id="status-{{ $admin->id }}"
                        data-url="{{ route('admin.user.admin-user.status', $admin->id) }}"
                        onchange="changeStatus({{ $admin->id }})" @if ($admin->status === 1)
                    checked
                    @endif>
                </td>

                <td>
                    <span>
                        <a href="{{ route('admin.user.admin-user.roles', $admin->id) }}"
                            class="button button-success">نقش</a>
                        <a href="{{ route('admin.user.admin-user.edit', $admin->id) }}"
                            class="button button-warning">ویرایش</a>
                        <form action="{{ route('admin.user.admin-user.destroy', $admin->id) }}" method="POST">
                            @csrf
                            {{ method_field('put') }}
                            <button type="submit" class="button button-danger delBtn">حذف از لیست</button>
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-activation.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
