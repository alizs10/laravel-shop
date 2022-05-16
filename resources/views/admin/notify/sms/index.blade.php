@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | اعلامیه پیامکی</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش اطلاع رسانی</a></li>/
            <li>اعلامیه پیامکی</li>


        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>اعلامیه پیامکی</h2>
            <a href="{{ route('admin.notify.sms.create') }}" class="button button-info">افزودن اعلامیه پیامکی جدید</a>
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
                    <td>وضعیت</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>


                @foreach ($smses as $key => $sms)
                    <tr>

                        <td @if ($key += 1 % 2 !== 0)
                            class="active-row"
                @endif>{{ $key }}</td>
                <td>{{ $sms->title }}</td>
                <td>{{ Str::limit($sms->body, 25, ' ...') }}</td>
                <td>{{ persianDateShow($sms->published_at, 'Y-m-d H:i:s') }}</td>
                <td>
                    <input type="checkbox" id="status-{{ $sms->id }}"
                        data-url="{{ route('admin.notify.sms.status', $sms->id) }}"
                        onchange="changeStatus({{ $sms->id }})" @if ($sms->status === 1)
                    checked
                    @endif>
                </td>
                <td>
                    <span>
                        <a href="{{ route('admin.notify.sms.edit', $sms->id) }}" class="button button-warning">ویرایش</a>
                        <form action="{{ route('admin.notify.sms.destroy', $sms->id) }}" method="sms">
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
