@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | پیج ساز</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش محتوی</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">پیج ساز</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">پیج ساز</span>
            @can('create', \App\Models\Content\Page::class)
                <a href="{{ route('admin.content.page.create') }}" class="btn bg-blue-600 text-white">افزودن پیج جدید</a>
            @endcan
        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>آدرس</th>
                        <th>تگ ها</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($pages as $page)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $page->title }}</td>
                            <td>{{ $page->url() }}</td>
                            <td>{{ $page->tags }}</td>
                            @can('update', \App\Models\Content\Page::class)
                                <td>
                                    <input type="checkbox" id="status-{{ $page->id }}"
                                        data-url="{{ route('admin.content.page.status', $page->id) }}"
                                        onchange="changeStatus({{ $page->id }})"
                                        @if ($page->status === 1) checked @endif>
                                </td>
                            @endcan
                            <td>
                                <span class="flex items-center gap-x-1">
                                    @can('update', \App\Models\Content\Page::class)
                                        <a href="{{ route('admin.content.page.edit', $page->id) }}"
                                            class="btn bg-yellow-500 text-black flex-center gap-1">
                                            <i class="fa-light fa-pen-to-square"></i>
                                            ویرایش
                                        </a>
                                    @endcan
                                    @can('delete', \App\Models\Content\Page::class)
                                        <form class="m-0" action="{{ route('admin.content.page.destroy', $page->id) }}"
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
