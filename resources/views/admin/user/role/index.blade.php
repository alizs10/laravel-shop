@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش کاربران | سطوح دسترسی</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش کاربران</a></li>/
            <li>سطوح دسترسی</li>


        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>سطوح دسترسی</h2>
            <a href="{{ route('admin.user.role.create') }}" class="button button-info">افزودن نقش جدید</a>
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
                    <td>نقش</td>
                    <td>توضیح</td>
                    <td>دسترسی ها</td>
                    <td>وضعیت</td>
                    <td class="w-20">عملیات</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($roles as $key => $role)

                    <tr>
                        <td @if ($key += 1 % 2 !== 0)
                            class="active-row"
                @endif>{{ $key }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td class="flex-column">
                    @foreach ($role->permissions as $num => $permission)

                        <div>
                            {{($num + 1) . '- ' .$permission->name }}
                        </div>
                        
                    @endforeach
                
                </td>


                <td>
                    <input type="checkbox" id="status-{{ $role->id }}"
                        data-url="{{ route('admin.user.role.status', $role->id) }}"
                        onchange="changeStatus({{ $role->id }})" @if ($role->status === 1)
                    checked
                    @endif>
                </td>
                <td>
                    <span>
                        <a href="{{ route('admin.user.permission.edit', $role->id) }}" class="button button-success">دسترسی ها</a>
                        <a href="{{ route('admin.user.role.edit', $role->id) }}" class="button button-warning">ویرایش</a>
                        <form action="{{ route('admin.user.role.destroy', $role->id) }}" method="POST">
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