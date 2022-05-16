@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | اعلامیه پیامکی جدید</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش اطلاع رسانی</a></li>/
            <li><a class="text-primary" href="{{ route('admin.notify.sms.index') }}">اعلامیه پیامکی</a></li>/
            <li>اعلامیه پیامکی جدید</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>اعلامیه پیامکی جدید</h2>
            <a href="{{ route('admin.notify.sms.index') }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.notify.sms.store') }}" method="POST">
            @csrf
            <div class="row-head">

                <div class="form-input-half">
                    <label @if ($errors->has('title'))
                        class="text-danger"
                        @endif for="title">عنوان پیامک</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}">
                </div>


                <div class="form-input-half">
                    <label @if ($errors->has('published_at'))
                        class="text-danger"
                        @endif for="published_at">تاریخ انتشار</label>
                    <input type="hidden" name="published_at" value="{{ old('published_at') }}" id="published_at">
                    <input type="text" id="published_at_view" value="{{ old('published_at') }}" readonly>
                </div>



                <div class="form-input-full">
                    <label @if ($errors->has('status'))
                        class="text-danger"
                        @endif for="status">وضعیت</label>
                    <select name="status" id="status">
                        <option value="1" @if (old('status') == 1)
                            selected
                            @endif>فعال</option>
                        <option value="0" @if (old('status') == 0)
                            selected
                            @endif>غیرفعال</option>
                    </select>
                </div>

                <div class="form-input-full">
                    <label @if ($errors->has('body'))
                        class="text-danger"
                        @endif for="body">متن پیامک</label>
                    <textarea name="body" rows="6">{{ old('body') }}</textarea>
                </div>


            </div>

            <div class="row-head">
                <button type="submit" class="button button-primary">ثبت</button>
            </div>

        </form>


    </div>
@endsection

@section('script')
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/jalali-persian-date-plus-time.js') }}"></script>
@endsection
