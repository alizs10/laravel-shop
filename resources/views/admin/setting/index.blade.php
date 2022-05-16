@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | تنظیمات</title>
@endsection

@section('content')
<div class="box-container">
    <ol class="route-map-group">
        <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
        <li>تنظیمات</li>
        

    </ol>
</div>

<div class="box-container">
    <div class="row-head">
        <h2>تنظیمات</h2>
    </div>


    <table class="styled-table">
        <thead>
            <tr>
                <td>شناسه</td>
                <td>عنوان سایت</td>
                <td>توضیحات سایت</td>
                <td>کلمات کلیدی سایت</td>
                <td>لوگو سایت</td>
                <td>آیکون سایت</td>
                <td>عملیات</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>۱</td>
                <td>{{ $setting->title }}</td>
                <td>{{ Str::limit($setting->description, 15, ' ...') }}</td>
                <td>{{ Str::limit($setting->keywords, 15, ' ...') }}</td>
                <td><img class="max-width-5" src="{{asset($setting->logo)}}" alt="logo"></td>
                <td><img class="max-width-5" src="{{asset($setting->icon)}}" alt="icon"></td>
                <td>
                    <span>
                        <a href="{{ route('admin.setting.edit', $setting->id) }}" class="button button-warning">ویرایش</a>
                    </span>
                </td>
            </tr>
            

        </tbody>
    </table>

</div>
@endsection
