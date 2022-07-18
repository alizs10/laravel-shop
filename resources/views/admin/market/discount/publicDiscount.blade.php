@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | تخفیف های عمومی</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">تخفیف های عمومی</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">

        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">تخفیف های عمومی</span>

            @can('create', \App\Models\Market\PublicDiscount::class)
                <a href="{{ route('admin.market.discount.public.create') }}" class="btn bg-blue-600 text-white">ایجاد تخفیف
                    عمومی
                    جدید</a>
            @endcan
        </div>
        <div class="grid grid-cols-12 gap-2">

            <div class="col-span-8 md:col-span-10 flex gap-2 bg-slate-200 dark:bg-slate-700 items-center rounded-lg">
                <input type="text"
                    class="w-5/6 px-2 py-2 md:py-4 font-light text-black dark:text-white text-sm bg-transparent border-none focus:border-none focus:ring-0 focus:outline-none placeholder:text-xxs md:placeholder:text-sm"
                    placeholder="دنبال چی میگردی">
                <span class="w-1/6 text-purple-800 dark:text-purple-400 text-lg md:text-2xl flex justify-end">
                    <i class="fa-light fa-magnifying-glass ml-2"></i>
                </span>
            </div>
            <div
                class="col-span-4 md:col-span-2 flex items-center rounded-lg bg-slate-200 dark:bg-slate-700 overflow-hidden">
                <select name="" id="" style="direction: ltr"
                    class="w-full font-light text-sm bg-transparent px-2 py-2 md:py-4 dark:focus:text-slate-50 focus:bg-slate-200 dark:focus:bg-slate-500 border-none focus:border-none focus:ring-0 focus:outline-none">
                    <option class="bg-transparent" value="10">10</option>
                    <option value="30">20</option>
                    <option value="20">30</option>
                </select>
                <span class="text-purple-800 dark:text-purple-400 mx-2">
                    <i class="fa-light fa-hashtag"></i>
                </span>
            </div>
        </div>

        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>عنوان تخفیف</th>
                        <th>میزان تخفیف</th>
                        <th>زمان شروع تخفیف</th>
                        <th>زمان پایان تخفیف</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">

                    @foreach ($discounts as $discount)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $discount->title }}</td>
                            <td>{{ $discount->percentage }} %</td>
                            <td>{{ showPersianDate($discount->valid_from) }}</td>
                            <td>{{ showPersianDate($discount->valid_until) }}</td>
                            <td>{{ $discount->status == 1 ? 'فعال' : 'غیرفعال' }}</td>
                            <td>
                                <span class="flex items-center gap-x-1">
                                    @can('update', \App\Models\Market\PublicDiscount::class)
                                        <a href="{{ route('admin.market.discount.public.edit', $discount->id) }}"
                                            class="btn bg-yellow-500 text-black flex-center gap-1">
                                            <i class="fa-light fa-pen-to-square"></i>
                                            ویرایش
                                        </a>
                                    @endcan
                                    @can('delete', \App\Models\Market\PublicDiscount::class)
                                        <form class="m-0"
                                            action="{{ route('admin.market.discount.public.destroy', $discount->id) }}"
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
