@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین پیشرفته</title>
@endsection

@section('content')
    <section class="flex flex-col gap-y-2 m-2">
        <span class="text-xs">نمای کلی</span>
        <div class="grid grid-cols-4 gap-2">
            <div class="col-span-4 md:col-span-2 lg:col-span-1 p-2 rounded-lg text-black bg-emerald-200">
                <div class="flex flex-col">
                    <div class="flex justify-between">
                        <span class="text-xs font-bold md:text-base">بازدید ها</span>
                        <i class="fa fa-eye text-3xl"></i>
                    </div>
                    <span class="text-2xl text-slate-800 font-bold md:text-3xl">1201</span>
                    <span class="text-xxs md:text-xs text-slate-700">
                        <i class="fa-regular fa-clock text-xs md:text-sm ml-1"></i>
                        آخرین بروزرسانی 5 دقیقه قبل</span>
                </div>
            </div>
            <div class="col-span-4 md:col-span-2 lg:col-span-1 p-2 rounded-lg text-black bg-red-200">
                <div class="flex flex-col">
                    <div class="flex justify-between">
                        <span class="text-xs font-bold md:text-base">محصولات</span>
                        <i class="fa-regular fa-boxes-stacked text-3xl"></i>
                    </div>
                    <span class="text-2xl text-slate-800 font-bold md:text-3xl">{{ $data['productsCount'] }}</span>
                    <span class="text-xxs md:text-xs text-slate-700">
                        <i class="fa-regular fa-clock text-xs md:text-sm ml-1"></i>
                    آخرین بروزرسانی در {{ showPersianDate($data['date'], 'H:i:s') }}</span>
                </div>
            </div>
            <div class="col-span-4 md:col-span-2 lg:col-span-1 p-2 rounded-lg text-black bg-orange-200">
                <div class="flex flex-col">
                    <div class="flex justify-between">
                        <span class="text-xs font-bold md:text-base">کاربران</span>
                        <i class="fa-regular fa-users text-3xl"></i>
                    </div>
                    <span class="text-2xl text-slate-800 font-bold md:text-3xl">{{ $data['usersCount'] }}</span>
                    <span class="text-xxs md:text-xs text-slate-700">
                        <i class="fa-regular fa-clock text-xs md:text-sm ml-1"></i>
                        آخرین بروزرسانی در {{ showPersianDate($data['date'], 'H:i:s') }}</span>
                </div>
            </div>
            <div class="col-span-4 md:col-span-2 lg:col-span-1 p-2 rounded-lg text-black bg-blue-200">
                <div class="flex flex-col">
                    <div class="flex justify-between">
                        <span class="text-xs font-bold md:text-base">نظرات</span>
                        <i class="fa-regular fa-comments text-3xl"></i>
                    </div>
                    <span class="text-2xl text-slate-800 font-bold md:text-3xl">{{ $data['commentsCount'] }}</span>
                    <span class="text-xxs md:text-xs text-slate-700">
                        <i class="fa-regular fa-clock text-xs md:text-sm ml-1"></i>
                        آخرین بروزرسانی در {{ showPersianDate($data['date'], 'H:i:s') }}</span>
                </div>
            </div>
        </div>
    </section>
@endsection
