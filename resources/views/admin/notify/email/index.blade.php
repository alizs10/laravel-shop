@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | اعلامیه ایمیلی</title>
@endsection

@section('content')
<div class="box-container">
    <ol class="route-map-group">
        <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
        <li><a class="text-primary" href="">بخش اطلاع رسانی</a></li>/
        <li>اعلامیه ایمیلی</li>
        

    </ol>
</div>

<div class="box-container">
    <div class="row-head">
        <h2>اعلامیه ایمیلی</h2>
        <a href="{{ route('admin.notify.email.create') }}" class="button button-info">افزودن اعلامیه ایمیلی جدید</a>
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
                <td>عنوان اعلامیه</td>
                <td>متن اعلامیه</td>
                <td>تاریخ ارسال</td>
                <td>فایل های ضمیمه</td>
                <td>وضعیت</td>
                <td>عملیات</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($emails as $key => $email)
            <tr>

                <td @if ($key += 1 % 2 !== 0)
                    class="active-row"
        @endif>{{ $key }}</td>
        <td>{{ $email->subject }}</td>
        <td>{{ Str::limit(strip_tags(html_entity_decode($email->body)), 25, ' ...') }}</td>
        <td>{{ persianDateShow($email->published_at, 'Y-m-d H:i:s') }}</td>
        <td>{{ count($email->files) > 0 ? count($email->files) : 'بدون فایل' }}</td>
        <td>
            <input type="checkbox" id="status-{{ $email->id }}"
                data-url="{{ route('admin.notify.email.status', $email->id) }}"
                onchange="changeStatus({{ $email->id }})" @if ($email->status === 1)
            checked
            @endif>
        </td>
        <td>
            <span>
                <a href="{{ route('admin.notify.email-files.index', $email->id) }}" class="button button-success">فایل های ضمیمه شده</a>
                <a href="{{ route('admin.notify.email.edit', $email->id) }}" class="button button-warning">ویرایش</a>
                <form action="{{ route('admin.notify.email.destroy', $email->id) }}" method="post">
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