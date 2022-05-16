@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | ویرایش فایل اطلاعیه ایمیلی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش اطلاع رسانی</a></li>/
            <li><a class="text-primary" href="{{ route('admin.notify.email.index') }}">اطلاعیه ایمیلی</a></li>/
            <li><a class="text-primary" href="{{ route('admin.notify.email-files.index', $file->public_mail_id) }}">فایل
                    های اطلاعیه ایمیلی</a></li>/
            <li>{{ $file->email->subject }}</li>/
            <li>ویرایش فایل</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ویرایش فایل طلاعیه ایمیلی</h2>
            <a href="{{ route('admin.notify.email-files.index', $file->public_mail_id) }}"
                class="button button-info">بازگشت</a>
        </div>

        @if ($errors->any())
            <div class="row-head bg-danger rounded">
                <ul class="flex-column flex-row-gap-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-white text-size-1 mr-space">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.notify.email-files.update', $file->id) }}" method="POST" id="form">
            @csrf
            {{ method_field('put') }}
            <div class="row-head">

                <div class="form-input-half">
                    <label @if ($errors->has('file_save_path'))
                        class="text-danger"
                        @endif for="public_mail_id">ایمیل</label>
                    <select name="public_mail_id" id="public_mail_id">
                        <option value="">ایمیل مورد نظر را مشخص کنید</option>
                        @foreach ($emails as $email)
                            <option value="{{ $email->id }}" @if (old('public_mail_id', $file->public_mail_id) == $email->id)
                                selected
                        @endif>{{ $email->subject }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('file_name'))
                        class="text-danger"
                        @endif for="file_name">نام فایل</label>
                    <input type="file_name" name="file_name" id="file_name"
                        value="{{ old('file_name', $file->file_name) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('file_description'))
                        class="text-danger"
                        @endif for="file_description">توضیحات فایل</label>
                    <input type="file_description" name="file_description" id="file_description"
                        value="{{ old('file_description', $file->file_description) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('file_save_path'))
                        class="text-danger"
                        @endif for="file_save_path">محل ذخیره</label>
                    <select name="file_save_path" id="file_save_path">
                        <option value="">محل دخیره را مشخص کنید</option>
                        <option value="0" @if (old('file_save_path', $file->file_save_path) === 0)
                            selected
                            @endif>عمومی</option>
                        <option value="1" @if (old('file_save_path', $file->file_save_path) === 1)
                            selected
                            @endif>خصوصی</option>
                    </select>
                </div>



            </div>
            <div class="row-head">
                <button type="submit" class="button button-primary">ثبت</button>
            </div>
        </form>






    </div>
@endsection
