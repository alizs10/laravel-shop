@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | مشتریان</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش کاربران</a></li>/
            <li>مشتریان</li>


        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>مشتریان</h2>
            <a href="{{ route('admin.user.customer.create') }}" class="button button-info">افزودن مشتری جدید</a>
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
                    <td>کد ملی</td>
                    <td>وضعیت کاربر</td>
                    <td>وضعیت</td>
                    <td class="w-10">عملیات</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr>
                        <td @if (($key + 1) % 2) !== 0)
                            class="active-row"
                @endif>{{ $key + 1 }}</td>
                <td>{{ $user->fullName }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->mobile }}</td>
                <td>{{ $user->national_code }}</td>
                <td>
                    <input type="checkbox" id="activation-{{ $user->id }}"
                        data-url="{{ route('admin.user.customer.activation', $user->id) }}"
                        onchange="changeActivation({{ $user->id }})" @if ($user->activation === 1)
                    checked
                    @endif>
                </td>
                <td>
                    <input type="checkbox" id="status-{{ $user->id }}"
                        data-url="{{ route('admin.user.customer.status', $user->id) }}"
                        onchange="changeStatus({{ $user->id }})" @if ($user->status === 1)
                    checked
                    @endif>
                </td>

                <td>
                    <span>
                        <a href="{{ route('admin.user.customer.edit', $user->id) }}"
                            class="button button-warning">ویرایش</a>


                        <button type="submit" class="button {{ $user->type == 0 ? 'button-success' : '' }}"
                            id="user-{{ $user->id }}"
                            data-url="{{ route('admin.user.customer.change-user-type', $user->id) }}"
                            onclick="changeUserType({{ $user->id }})">
                            {{ $user->type == 0 ? 'ادمین شو' : 'حذف ادمین' }}
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-status.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-activation.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-user-type.js') }}"></script>
@endsection
