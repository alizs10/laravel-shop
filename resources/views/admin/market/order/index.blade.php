@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | {{ $page }}</title>
@endsection

@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">{{ $page }}</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <span class="text-sm md:text-lg">سفارشات</span>
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

                <thead class="text-xxs md:text-xs">
                    <tr>
                        <th>#</th>
                        <th>کد سفارش</th>
                        <th>مبلغ نهایی</th>
                        <th>وضعیت پرداخت</th>
                        <th>شیوه پرداخت</th>
                        <th>درگاه</th>
                        <th>شیوه ارسال</th>
                        <th>وضعیت ارسال</th>
                        <th>وضعیت سفارش</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-xs">

                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ 'LSC-' . $order->id }}</td>
                            <td>{{ price_formater($order->payment->amount) }} تومان</td>
                            <td>{{ $order->payment->status() }}</td>
                            <td>{{ $order->payment->type() }}</td>
                            <td>{{ $order->payment->paymentable->gateway ?? '-' }}</td>
                            <td>{{ $order->delivery->name }}</td>
                            <td>{{ $order->deliveryStatus() }}</td>
                            <td>{{ $order->status() }}</td>
                            <td>
                                <div class="relative">
                                    <button onclick="toggleDropdown('dropdown-{{ $order->id }}')"
                                        id="toggle-dropdown-{{ $order->id }}"
                                        class="btn bg-blue-600 text-white flex-center gap-1">
                                        عملیات
                                        <i class="fa-regular fa-angle-down mr-space"></i>
                                    </button>

                                    <div class="hidden absolute top-10 left-0 w-56 h-fit rounded-lg bg-white dark:bg-slate-900 flex flex-col overflow-hidden"
                                        id={{ "dropdown-{$order->id}" }}>
                                        <a href="{{ route('admin.market.order.show', $order->id) }}"
                                            class="py-2 w-full text-sm h-full flex items-center gap-x-2 hover-transition hover:bg-slate-100 dark:hover:bg-slate-800">
                                            <i class="fa-regular fa-eye mr-2"></i>
                                            مشاهده فاکتور</a>
                                        @can('update', \App\Models\Market\Payment::class)
                                            <a href="{{ route('admin.market.order.change-delivery-status', $order->id) }}"
                                                class="py-2 w-full text-sm h-full flex items-center gap-x-2 hover-transition hover:bg-slate-100 dark:hover:bg-slate-800">
                                                <i class="fa-light fa-truck mr-2"></i>
                                                تغییر وضعیت ارسال</a>
                                            <a href="{{ route('admin.market.order.change-status', $order->id) }}"
                                                class="py-2 w-full text-sm h-full flex items-center gap-x-2 hover-transition hover:bg-slate-100 dark:hover:bg-slate-800">
                                                <i class="fa-light fa-rectangle-list mr-2"></i>
                                                تغییر وضعیت سفارش</a>
                                        @endcan
                                        @can('delete', \App\Models\Market\Payment::class)
                                            <form class="w-full m-0"
                                                action="{{ route('admin.market.order.destroy', $order->id) }}"
                                                method="POST">
                                                @csrf
                                                {{ method_field('delete') }}
                                                <button
                                                    class="py-2 w-full text-sm h-full flex items-center gap-x-2 hover-transition hover:bg-slate-100 dark:hover:bg-slate-800 delBtn">
                                                    <i class="fa-regular fa-trash-can mr-2"></i>
                                                    حذف</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>




            </table>

        </section>


    </section>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/dropdown-btn.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
