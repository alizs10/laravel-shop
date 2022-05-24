@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | نمایش نظر</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">نمایش نظر</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">

        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">نمایش نظر</span>
            <a href="{{ route('admin.market.comment.index') }}" class="btn bg-blue-600 text-white">بازگشت</a>

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

        <div class="rounded-lg p-2 bg-emerald-300 flex flex-col gap-y-2">
            <span class="flex justify-between items-center text-gray-700">
                <span class="text-sm">
                    {{ $comment->user->fullName . ' - ' . $comment->commentable->name }}
                </span>
                <span class="text-xs">{{ showPersianDate($comment->created_at) }}</span>
            </span>

            <p class="text-black text-sm md:text-base text-justify leading-6">
                {{ html_entity_decode(strip_tags($comment->body)) }}
            </p>
        </div>

        <span class="text-sm {{ $errors->has('body') ? 'text-red-600 dark:text-red-400' : 'text-gray-500' }}">پاسخ
            ادمین</span>

        <form action="{{ route('admin.market.comment.store', $comment->id) }}" method="POST" class="w-full">
            @csrf
            <section class="w-full flex flex-col gap-y-2">
                <textarea name="body" id="body" rows="6">{{ old('body') }}</textarea>
                <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ارسال
                    پاسخ</button>
            </section>
        </form>
    </section>

@endsection
@section('script')
    <script src="{{ asset('admin-assets/packages/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        ClassicEditor
            .create(document.querySelector('#body'), {
                language: 'fa',
                placeholder: 'پاسخ خود را اینجا وارد کنید'
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
