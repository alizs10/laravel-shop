@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | پست ها</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش محتوی</a></li>/
            <li>پست ها</li>


        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>پست ها</h2>
            <a href="{{ route('admin.content.post.create') }}" class="button button-info">افزودن پست جدید</a>
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
                    <td>عنوان پست</td>
                    <td>دسته</td>
                    <td>اسلاگ</td>
                    <td>تصویر</td>
                    <td>تگ ها</td>
                    <td>نظرات</td>
                    <td>وضعیت</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $key => $post)

                    <tr>
                        <td @if ($key += 1 % 2 !== 0)
                            class="active-row"
                @endif>{{ $key }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->postCategory->name }}</td>
                <td>{{ $post->slug }}</td>
                <td>
                    <img src="{{ asset($post->image['indexArray']['small']) }}" alt="">
                </td>
                <td>{{ $post->tags }}</td>
                <td>
                    <input type="checkbox" id="commentable-{{ $post->id }}"
                        data-url="{{ route('admin.content.post.commentable', $post->id) }}"
                        onchange="commentable({{ $post->id }})" @if ($post->commentable === 1)
                    checked
                    @endif>
                </td>
                <td>
                    <input type="checkbox" id="status-{{ $post->id }}"
                        data-url="{{ route('admin.content.post.status', $post->id) }}"
                        onchange="changeStatus({{ $post->id }})" @if ($post->status === 1)
                    checked
                    @endif>
                </td>
                <td>
                    <span>
                        <a href="{{ route('admin.content.post.edit', $post->id) }}"
                            class="button button-warning">ویرایش</a>
                        <form action="{{ route('admin.content.post.destroy', $post->id) }}" method="POST">
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
<script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-commentable.js') }}"></script>    
<script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>    
@endsection