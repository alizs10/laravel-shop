@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | نظرات</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li>نظرات</li>


        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2 class="text-size-titr">نظرات</h2>
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
                    <td>#</td>
                    <td>پاسخ به</td>
                    <td>متن نظر</td>
                    <td>نام کاربر</td>
                    <td>عنوان پست</td>
                    <td>وضعیت</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $key => $comment)

                    <tr>
                        <td @if ($key += 1 % 2 !== 0)
                            class="active-row"
                @endif>{{ $key }}</td>
                <td>{{ $comment->parent ? Str::limit(strip_tags(html_entity_decode($comment->parent->body)), 15, ' ...') : '' }}
                </td>
                <td>{{ Str::limit(strip_tags(html_entity_decode($comment->body)), 15, ' ...') }}</td>
                <td>{{ $comment->user->fullName }}</td>
                <td>{{ $comment->commentable->name }}</td>
                <td class="@if ($comment->approved === 1)
                    text-success
                @else
                text-warning
                @endif
                "
                    id="approve-d-{{ $comment->id }}">
                    {{ $comment->approved ? 'تایید شده' : 'در انتظار تایید' }}</td>

                <td>
                    <span>
                        <a href="{{ route('admin.market.comment.show', $comment->id) }}"
                            class="button button-primary">دیدن</a>


                        <button type="button"
                            class="button @if ($comment->approved === 1)
                                button-warning
                            @else
                                button-success
                            @endif"
                            id="approve-{{ $comment->id }}"
                            data-url=" {{ route('admin.market.comment.approve', $comment->id) }}"
                            onclick="approve({{ $comment->id }})">
                            @if ($comment->approved === 1)
                                عدم تایید
                            @else
                                تایید
                            @endif

                        </button>

                    </span>
                </td>

                </tr>

                @endforeach

            </tbody>
        </table>

    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-approve.js') }}"></script>
@endsection
