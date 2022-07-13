@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | تنظیمات</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs md:text-base">بخش تنظیمات</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <span class="text-sm md:text-lg">تنظیمات</span>

        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>عنوان سایت</th>
                        <th>توضیحات سایت</th>
                        <th>کلمات کلیدی سایت</th>
                        <th>لوگو سایت</th>
                        <th>آیکون سایت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">


                    <tr>
                        <td>۱</td>
                        <td>{{ $setting->title }}</td>
                        <td>{{ Str::limit($setting->description, 15, ' ...') }}</td>
                        <td>{{ Str::limit($setting->keywords, 15, ' ...') }}</td>
                        <td><img class="w-20" src="{{ asset($setting->logo) }}" alt="logo"></td>
                        <td><img class="w-20" src="{{ asset($setting->icon) }}" alt="icon"></td>
                        @can('update', \App\Models\Setting\Setting::class)
                            <td>
                                <a href="{{ route('admin.setting.edit', $setting->id) }}"
                                    class="btn bg-yellow-500 text-black flex-center gap-1">
                                    <i class="fa-light fa-pen-to-square"></i>
                                    ویرایش
                                </a>
                            </td>
                        @endcan

                    </tr>



                </tbody>




            </table>

        </section>


    </section>
@endsection
