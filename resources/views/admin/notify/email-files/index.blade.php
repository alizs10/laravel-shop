@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش اطلاع رسانی | فایل های اطلاعیه ایمیلی</title>
@endsection

@section('content')


<div class="box-container">
    <ol class="route-map-group">
        <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
        <li><a class="text-primary" href="">بخش اطلاع رسانی</a></li>/
        <li><a class="text-primary" href="{{ route('admin.notify.email.index') }}">اطلاعیه ایمیلی</a></li>/
        <li>فایل های اطلاعیه ایمیلی</li>
        

    </ol>
</div>

<div class="box-container">
    <div class="row-head">
        <h2>فایل های <span class="text-danger">" {{ $email->subject }} "</span></h2>
        <a href="{{ route('admin.notify.email-files.create', $email->id) }}" class="button button-info">افزودن فایل جدید</a>
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
                <td>نام فایل</td>
                <td>محل ذخیره فایل</td>
                <td>توضیحات فایل</td>
                <td>نوع فایل</td>
                <td>حجم فایل</td>
                <td>عملیات</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($email->files as $key => $file)
            <tr>

                <td @if ($key += 1 % 2 !== 0)
                    class="active-row"
        @endif>{{ $key }}</td>
        <td>{{ $file->file_name }}</td>
        <td>{{ $file->file_save_path === 1 ? 'خصوصی' : 'عمومی' }}</td>
        <td>{{ $file->file_description }}</td>
        <td>{{ $file->file_type }}</td>
        <td>{{ $file->file_size . ' بایت' }}</td>
        <td>
            <span>
                <a href="{{ route('admin.notify.email-files.edit', $file->id) }}" class="button button-warning">ویرایش</a>
                <form action="{{ route('admin.notify.email-files.destroy', $file->id) }}" method="post">
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
<script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection