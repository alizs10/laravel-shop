@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | ویرایش اطلاعیه ایمیلی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش اطلاعیه ها</a></li>/
            <li><a class="text-primary" href="{{ route('admin.notify.email.index') }}">اطلاعیه ایمیلی</a></li>/
            <li>ویرایش طلاعیه ایمیلی</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ویرایش طلاعیه ایمیلی</h2>
            <a href="{{ route('admin.notify.email.index') }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.notify.email.update', $email->id) }}" method="POST" id="form">
            @csrf
            {{ method_field('put') }}
            <div class="row-head">
                <div class="form-input-half">
                    <label @if ($errors->has('subject'))
                        class="text-danger"
                        @endif for="subject">عنوان ایمیل</label>
                    <input type="text" name="subject" id="subject" value="{{ old('subject', $email->subject) }}">
                </div>


                <div class="form-input-half">
                    <label @if ($errors->has('published_at'))
                        class="text-danger"
                        @endif for="published_at">تاریخ انتشار</label>
                    <input type="hidden" name="published_at" value="{{ old('published_at', $email->published_at) }}"
                        id="published_at">
                    <input type="text" id="published_at_view" value="{{ old('published_at', $email->published_at) }}">
                </div>


                <div class="form-input-full">
                    <label @if ($errors->has('status'))
                        class="text-danger"
                        @endif for="status">وضعیت</label>
                    <select name="status" id="status">
                        <option value="1" @if (old('status', $email->status) == 1)
                            selected
                            @endif>فعال</option>
                        <option value="0" @if (old('status', $email->status) == 0)
                            selected
                            @endif>غیرفعال</option>
                    </select>
                </div>

                <div class="form-input-full">
                    <label @if ($errors->has('body'))
                        class="text-danger"
                        @endif for="cke">متن</label>
                    <textarea name="body" id="cke" rows="6">{{ old('body', $email->body) }}</textarea>
                </div>


            </div>
            <div class="row-head">
                <button type="submit" class="button button-primary">ثبت</button>
            </div>
        </form>






    </div>
@endsection

@section('script')
    <script src="{{ asset('admin-assets/js/select2tags.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/js/ckreplace.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/jalali-persian-date-plus-time.js') }}"></script>

@endsection
