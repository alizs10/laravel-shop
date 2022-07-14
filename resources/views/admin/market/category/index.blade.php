@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | دسته بندی</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">دسته بندی</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">دسته بندی</span>
            @can('create', \App\Models\Market\ProductCategory::class)
                <a href="{{ route('admin.market.category.create') }}" class="btn bg-blue-600 text-white">افزودن دسته بندی
                    جدید</a>
            @endcan
        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>نام دسته</th>
                        <th>دسته والد</th>
                        <th>تصویر</th>
                        <th>تگ ها</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($productCategories as $key => $productCategory)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $productCategory->name }}</td>
                            <td>{{ $productCategory->parent->name ?? 'دسته اصلی' }}</td>
                            <td>
                                <img src="{{ asset('storage\\' . $productCategory->image['indexArray']['small']) }}"
                                    alt="">
                            </td>
                            <td>{{ $productCategory->tags }}</td>
                            @can('update', \App\Models\Market\ProductCategory::class)
                                <td>
                                    <input type="checkbox" id="status-{{ $productCategory->id }}"
                                        data-url="{{ route('admin.market.category.status', $productCategory->id) }}"
                                        onchange="changeStatus({{ $productCategory->id }})"
                                        @if ($productCategory->status === 1) checked @endif>
                                </td>
                            @endcan
                            <td>
                                <span class="flex items-center gap-x-1">
                                    @can('update', \App\Models\Market\ProductCategory::class)
                                        <a href="{{ route('admin.market.category.edit', $productCategory->id) }}"
                                            class="btn bg-yellow-500 text-black flex-center gap-1">
                                            <i class="fa-light fa-pen-to-square"></i>
                                            ویرایش
                                        </a>
                                    @endcan
                                    @can('delete', \App\Models\Market\ProductCategory::class)
                                        <form class="m-0"
                                            action="{{ route('admin.market.category.destroy', $productCategory->id) }}"
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
