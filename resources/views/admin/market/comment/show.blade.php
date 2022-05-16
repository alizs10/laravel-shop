@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | نمایش نظر</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="#">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.content.comment.index') }}">نظرات</a></li>/
            <li>نمایش نظر</li>

        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2>نمایش نظر</h2>
            <a href="{{ route('admin.market.comment.index') }}" class="button button-info">بازگشت</a>
        </div>

        @if ($errors->any())
            <div class="row-head bg-danger py-1 rounded">
                <ul class="flex-column flex-row-gap-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-white text-size-1 mr-space">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex-column flex-row-gap-2">

            @if ($comment->parent)
                <h3>{{ $comment->parent->user->fullName . ' - ' . $comment->parent->author_id }}</h3>

                <div class="w-100 bg-g-blue rounded">
                    <p class="m-space">{{ strip_tags(html_entity_decode($comment->parent->body)) }}</p>
                </div>
            @endif


            <h3>{{ $comment->user->fullName . ' - ' . $comment->author_id }}</h3>

            <div class="w-100 bg-g-green rounded">
                <p class="m-space">{{ strip_tags(html_entity_decode($comment->body)) }}</p>
            </div>

            @if ($comment->children)
                @foreach ($comment->children as $childComment)
                    <h3>{{ $childComment->user->fullName . ' - ' . $childComment->author_id }}</h3>

                    <div class="w-100 bg-g-blue rounded">
                        <p class="m-space">{{ strip_tags(html_entity_decode($childComment->body)) }}</p>
                    </div>
                @endforeach
            @endif


            @if (!$comment->parent_id)
                <form class="w-100"
                    action="{{ route('admin.market.comment.store', $comment->id) }}" method="POST">
                    @csrf

                    <div class="form-input-full">
                        <label @if ($errors->has('answer'))
                            class="text-danger"
                                @endif>پاسخ ادمین</label>
                    <textarea name="body" id="cke" rows="4">{{ old('body') }}</textarea>

                    <div class="row-head mt-space">
                     <button type="submit" class="button button-success w-100">ارسال پاسخ</button>
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
