@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | نظرات</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش محتوی</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">نظرات</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">نظرات</span>
        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>پاسخ به</th>
                        <th>متن نظر</th>
                        <th>نام کاربر</th>
                        <th>عنوان پست</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($comments as $comment)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $comment->parent ? Str::limit(strip_tags(html_entity_decode($comment->parent->body)), 15, ' ...') : '' }}
                            </td>
                            <td>{{ Str::limit(strip_tags(html_entity_decode($comment->body)), 15, ' ...') }}</td>
                            <td>{{ $comment->user->fullName }}</td>
                            <td>{{ $comment->commentable->title }}</td>
                            <td class="@if ($comment->approved === 1) text-success
                        @else
                        text-warning @endif
                        "
                                id="approve-d-{{ $comment->id }}">
                                {{ $comment->approved ? 'تایید شده' : 'در انتظار تایید' }}</td>
                            <td>
                                <span class="flex items-center gap-x-1">
                                    @can('index', \App\Models\Comment::class)
                                        <a href="{{ route('admin.content.comment.show', $comment->id) }}"
                                            class="btn text-white bg-blue-600 flex-center gap-1">
                                            <i class="fa-light fa-eye"></i>
                                            دیدن
                                        </a>
                                    @endcan
                                    @can('update', \App\Models\Comment::class)
                                        <button data-url=" {{ route('admin.content.comment.approve', $comment->id) }}"
                                            onclick="approve({{ $comment->id }})" id="approve-{{ $comment->id }}"
                                            class="btn {{ $comment->approved === 1 ? 'bg-red-400' : 'bg-emerald-400' }} text-black flex-center gap-1">

                                            <span>
                                                {{ $comment->approved === 1 ? 'عدم تایید' : 'تایید' }}
                                            </span>
                                        </button>
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-approve.js') }}"></script>
@endsection
