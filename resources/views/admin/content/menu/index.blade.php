@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | منو ها</title>
@endsection

@section('content')
<div class="box-container">
    <ol class="route-map-group">
        <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
        <li><a class="text-primary" href="">بخش محتوی</a></li>/
        <li>منو ها</li>
        

    </ol>
</div>

<div class="box-container">
    <div class="row-head">
        <h2>منو ها</h2>
        <a href="{{ route('admin.content.menu.create') }}" class="button button-info">افزودن منوی جدید</a>
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
                <td>منو</td>
                <td>منو والد</td>
                <td>آدرس</td>
                <td>وضعیت</td>
                <td>عملیات</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $key => $menu)

            <tr>
                <td @if ($key += 1 % 2 !== 0)
                    class="active-row"
        @endif>{{ $key }}</td>
        <td>{{ $menu->name }}</td>
        <td>{{ $menu->parent_id ? $menu->parent($menu->parent_id) : 'اصلی'; }}</td>
        <td>{{ $menu->url }}</td>
        <td>
            <input type="checkbox" id="status-{{ $menu->id }}"
                data-url="{{ route('admin.content.menu.status', $menu->id) }}"
                onchange="changeStatus({{ $menu->id }})" @if ($menu->status === 1)
            checked
            @endif>
        </td>
        <td>
            <span>
                <a href="{{ route('admin.content.menu.edit', $menu->id) }}"
                    class="button button-warning">ویرایش</a>
                <form action="{{ route('admin.content.menu.destroy', $menu->id) }}" method="post">
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