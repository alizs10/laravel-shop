@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | پست ها</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش محتوی</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">پست ها</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">پست ها</span>
            @can('create', \App\Models\Content\Post::class)
                <a href="{{ route('admin.content.post.create') }}" class="btn bg-blue-600 text-white">افزودن پست جدید</a>
            @endcan
        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>عنوان پست</th>
                        <th>دسته</th>
                        <th>نویسنده</th>

                        <th>تصویر</th>

                        <th>نظرات</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($posts as $post)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->postCategory->name }}</td>
                            <td>{{ $post->author->fullName }}</td>

                            <td>
                                @if ($post->image)
                                    <img src="{{ asset('storage\\' . $post->image['indexArray']['small']) }}"
                                        alt="">
                                @endif
                            </td>
                            @can('update', $post)
                                <td>
                                    <input type="checkbox" id="commentable-{{ $post->id }}"
                                        data-url="{{ route('admin.content.post.commentable', $post->id) }}"
                                        onchange="commentable({{ $post->id }})"
                                        @if ($post->commentable === 1) checked @endif>
                                </td>
                                <td>
                                    <input type="checkbox" id="status-{{ $post->id }}"
                                        data-url="{{ route('admin.content.post.status', $post->id) }}"
                                        onchange="changeStatus({{ $post->id }})"
                                        @if ($post->status === 1) checked @endif>
                                </td>
                            @endcan
                            <td>
                                <span class="flex items-center gap-x-1">
                                    @can('update', $post)
                                        <a href="{{ route('admin.content.post.edit', $post->id) }}"
                                            class="btn bg-yellow-500 text-black flex-center gap-1">
                                            <i class="fa-light fa-pen-to-square"></i>
                                            ویرایش
                                        </a>
                                    @endcan
                                    @can('delete', $post)
                                        <form class="m-0" action="{{ route('admin.content.post.destroy', $post->id) }}"
                                            method="POST">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <button class="btn bg-red-400 text-black flex-center gap-1 delBtn">
                                                <i class="fa-light fa-trash-can"></i>
                                                حذف
                                            </button>
                                        </form>
                                    @endcan

                                </span>
                            </td>


                        </tr>
                    @endforeach

                </tbody>




            </table>

        </section>


    </section>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-status.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-commentable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
