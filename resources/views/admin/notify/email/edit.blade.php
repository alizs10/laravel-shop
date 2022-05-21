@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | ویرایش اطلاعیه ایمیلی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش اطلاع رسانی</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.notify.sms.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">اطلاعیه ایمیلی</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">ویرایش اطلاعیه ایمیلی</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">

        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">ویرایش اطلاعیه ایمیلی</span>
            <a href="{{ route('admin.notify.email.index') }}" class="btn bg-blue-600 text-white">بازگشت</a>
        </div>

        @if ($errors->any())
            <div class="flex flex-col gap-y-1 rounded-lg bg-red-200 p-2">
                <span class="text-xs">خطا های فرم:</span>
                @foreach ($errors->all() as $error)
                    <div class="flex gap-x-1 text-red-600 items-center">
                        <span class="text-base">
                            <i class="fa-light fa-diamond-exclamation"></i>
                        </span>
                        <span class="text-sm">{{ $error }}</span>
                    </div>
                @endforeach

            </div>
        @endif


        <form class="w-full" action="{{ route('admin.notify.email.update', $email->id) }}" method="POST"
            enctype="multipart/form-data" id="form">
            @csrf
            @method('put')
            <section class="w-full grid grid-cols-2 gap-2">
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="subject"
                        class="text-xs {{ $errors->has('subject') ? 'text-red-600 dark:text-red-400' : '' }}">موضوع
                        ایمیل</label>
                    <input type="text" class="form-input" name="subject" id="subject" value="{{ old('subject', $email->subject) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="description"
                        class="text-xs {{ $errors->has('description') ? 'text-red-600 dark:text-red-400' : '' }}">تاریخ
                        انتشار
                    </label>
                    <input type="hidden" name="published_at" id="published_at">
                    <input type="text" class="form-input" name="published_at_view" id="published_at_view" readonly>
                </div>
                <div class="col-span-2  flex flex-col gap-y-1">
                    <label for="status"
                        class="text-xs {{ $errors->has('status') ? 'text-red-600 dark:text-red-400' : '' }}">وضعیت</label>
                    <select name="status" id="status" class="form-select" style="direction: ltr">
                        <option value="1" @if (old('status', $email->status) == 1) selected @endif>فعال</option>
                        <option value="0" @if (old('status', $email->status) == 0) selected @endif>غیرفعال</option>
                    </select>
                </div>
                <div class="col-span-2 flex flex-col gap-y-1">
                    <label for="body"
                        class="text-xs {{ $errors->has('body') ? 'text-red-600 dark:text-red-400' : '' }}">متن
                        ایمیل</label>
                    <textarea name="body" id="cke" rows="6">{{ old('body', $email->body) }}</textarea>
                </div>

                <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
            </section>
        </form>
    </section>
@endsection

@section('script')
    <script src="{{ asset('admin-assets/js/select2tags.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/js/ckreplace.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/packages/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/jalali-persian-date-plus-time.js') }}"></script>
@endsection
