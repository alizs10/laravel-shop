@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | مشخصات کالا</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">مشخصات کالا</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">مشخصات کالا</span>
        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>نام دسته بندی</th>
                        <th>دسته والد</th>
                        <th>مشخصات</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($productCategories as $productCategory)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $productCategory->name }}</td>
                            <td>{{ $productCategory->parent->name ?? 'دسته اصلی' }}</td>
                            <td class="flex flex-col gap-y-2">
                                @if (count($productCategory->specs) > 0)
                                    @foreach ($productCategory->specs as $spec)
                                    @if ($loop->iteration > 4)
                                        <span>...</span>
                                        @break
                                    @endif
                                        <span>{{ $loop->iteration . '- ' . $spec->name }}</span>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <span class="flex items-center gap-x-1">

                                    <a href="{{ route('admin.market.category-spec.create', $productCategory->id) }}"
                                        class="btn bg-blue-600 text-white flex-center gap-1">
                                        <i class="fa-solid fa-plus"></i>
                                        اضافه کردن
                                    </a>
                                    <a href="{{ route('admin.market.category-spec.manage', $productCategory->id) }}"
                                        class="btn bg-yellow-500 text-black flex-center gap-1">
                                        <i class="fa-light fa-pen-to-square"></i>
                                        مدیریت مشخصات
                                    </a>



                                </span>
                            </td>

                        </tr>
                    @endforeach

                </tbody>




            </table>

        </section>


    </section>
@endsection
