@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | مشاهده فاکتور</title>
@endsection

@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">مشاهده فاکتور</span>

    </section>
@endsection

@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">نمایش فاکتور</span>

            <button onclick="print('print')" class="rounded-lg px-4 py-2 bg-slate-200 text-black flex items-center gap-x-1">
                <i class="fa-solid fa-print"></i>
                <span class="text-xs">چاپ فاکتور</span>
            </button>
        </div>
        <script type="text/javascript" src="{{ asset('admin-assets/js/print.js') }}"></script>

        <section id="print" class="w-full rounded-lg bg-white text-black border border-black overflow-scroll no-scrollbar">
            <table class="w-full">
                <div class="border border-black">
                    <p class="text-center py-2">مشخصات فروشنده</p>
                </div>
                <tbody>
                    <tr>
                        <td class="border border-black">نام شخص/شرکت:
                            فروشگاه اینترنتی لاراول
                        </td>
                        <td class="border border-black">

                            شماره اقتصادی: 135468431
                        </td>
                        <td class="border border-black">

                            شماره شناسه ملی: 0002165
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black">
                            نام استان: تهران

                        </td>
                        <td class="border border-black">
                            شهرستان: تهران

                        </td>
                        <td class="border border-black">

                            شماره ثبت: 7865
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black">
                            کد پستی: 64789456325

                        </td>
                        <td class="border border-black">
                            نشانی: شهرک صنغتی دوم، میدان اول، خیابان دوم شرقی

                        </td>
                        <td class="border border-black">
                            شماره تماس: 021-45687920

                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="w-full">
                <div class="border border-black">
                    <p class="text-center py-2">مشخصات خریدار</p>
                </div>
                <tbody>
                    <tr>
                        <td class="border border-black">
                            نام و نام خانوادگی: {{ $order->user->fullName }}

                        </td>
                        <td class="border border-black">
                            شماره شناسه نامه: 135468431

                        </td>
                        <td class="border border-black">

                            نام استان: {{ $order->address->city->province->name }}
                        </td>
                    </tr>
                    <tr>

                        <td class="border border-black">

                            شهرستان: {{ $order->address->city->name }}
                        </td>
                        <td class="border border-black">

                            نشانی: {{ $order->address->address }}
                        </td>
                        <td class="border border-black">
                            پلاک: {{ $order->address->no ?? '-' }}

                        </td>
                    </tr>
                    <tr>

                        <td class="border border-black">
                            واحد: {{ $order->address->unit ?? '-' }}

                        </td>
                        <td class="border border-black">
                            کد پستی: {{ $order->address->postal_code }}

                        </td>
                        <td class="border border-black">
                            شماره تماس: {{ $order->address->mobile }}

                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="w-full">
                <div class="border border-black">
                    <p class="text-center py-2">مشخصات کالاها</p>
                </div>
                <thead>
                    <tr class="border border-black">
                        <th>#</th>
                        <th>نام کالا</th>
                        <th>قیمت کالا</th>
                        <th>تعدلد</th>
                        <th>تخفیف</th>
                        <th>مالیات</th>
                        <th>هزینه نهایی</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border border-black">
                        <td>1</td>
                        <td>آیفون 14</td>
                        <td>36800000</td>
                        <td>2</td>
                        <td>4500000</td>
                        <td>0</td>
                        <td>36350000</td>
                    </tr>
                    <tr class="border border-black">
                        <td>1</td>
                        <td>آیفون 14</td>
                        <td>36800000</td>
                        <td>2</td>
                        <td>4500000</td>
                        <td>0</td>
                        <td>36350000</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>آیفون 14</td>
                        <td>36800000</td>
                        <td>2</td>
                        <td>4500000</td>
                        <td>0</td>
                        <td>36350000</td>
                    </tr>
                    <tr class="border border-black">
                        <td></td>
                        <td>جمع کل</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>136545000</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </section>
@endsection
