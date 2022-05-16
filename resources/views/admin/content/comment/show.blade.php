@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | نمایش نظر</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="#">بخش محتوی</a></li>/
            <li><a class="text-primary" href="{{ route('admin.content.comment.index') }}">نظرات</a></li>/
            <li>نمایش نظر</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>نمایش نظر</h2>
            <a href="{{ route('admin.content.comment.index') }}" class="button button-info">بازگشت</a>
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

        <div class="row-head">


            <h3>{{ $comment->user->fullName . ' - ' . $comment->author_id }}</h3>

            <div class="messageCard bg-g-green">
                <p>{{ strip_tags(html_entity_decode($comment->body)) }}</p>
            </div>

            @if (!$comment->parent_id)
            <form class="w-100" action="{{ route('admin.content.comment.store', $comment->id) }}" method="POST">
                @csrf

                <div class="form-input-full">
                    <label @if ($errors->has('answer'))
                        class="text-danger"
                        @endif>پاسخ ادمین</label>
                    <textarea name="body" id="cke" rows="4">{{ old('body') }}</textarea>
                </div>

                <div class="row-head">
                    <button type="submit" class="button button-success">ثبت</button>
                </div>
                

            </form>
            @endif

        </div>




    </div>
@endsection
@section('script')

    <script src="{{ asset('admin-assets/packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/js/ckreplace.js') }}"></script>

@endsection
