@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | انبار</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">انبار</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">انبار</span>

        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>نام کالا</th>
                        <th>تصویر کالا</th>
                        <th>قابل فروش</th>
                        <th>در سبد خرید</th>
                        <th>فروخته شده</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($products as $product)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td><img class="w-20"
                                    src="{{ asset('storage\\' . $product->image['indexArray'][$product->image['currentImage']]) }}"
                                    class="max-height-3rem"></td>
                            <td>{{ $product->marketable_number }}</td>
                            <td>{{ $product->frozen_number }}</td>
                            <td>{{ $product->sold_number }}</td>
                            <td>
                                <span class="flex items-center gap-x-1">
                                    @can('update', \App\Models\Market\Product::class)
                                        <a href="{{ route('admin.market.store.add-to-store', $product->id) }}"
                                            class="btn bg-blue-600 text-white flex-center gap-1">
                                            <i class="fa-solid fa-plus"></i>
                                            افزایش موجودی
                                        </a>
                                        <a href="{{ route('admin.market.store.edit', $product->id) }}"
                                            class="btn bg-yellow-500 text-black flex-center gap-1">
                                            <i class="fa-light fa-pen-to-square"></i>
                                            اصلاح موجودی
                                        </a>
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
