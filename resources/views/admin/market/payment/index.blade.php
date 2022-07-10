@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | {{ $page }}</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">{{ $page }}</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">{{ $page }}</span>

        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>کد تراکنش</th>
                        <th>درگاه</th>
                        <th>مبلغ پرداختی</th>
                        <th>پرداخت کننده</th>
                        <th>وضعیت پرداخت</th>
                        <th>شیوه پرداخت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($payments as $payment)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->transactionId() }}</td>
                            <td>{{ $payment->gateway() }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->user->fullName }}</td>
                            <td>{{ $payment->status() }}</td>
                            <td>{{ $payment->type() }}</td>
                            <td>
                                <span class="flex items-center gap-x-1">

                                    <a href="{{ route('admin.market.payment.show', $payment->id) }}"
                                        class="btn bg-blue-600 text-white flex-center gap-1">
                                        <i class="fa-solid fa-eye"></i>
                                        مشاهده
                                    </a>
                                    <a href="{{ route('admin.market.payment.cancel', $payment->id) }}"
                                        class="btn bg-yellow-500 text-black flex-center gap-1">
                                        <i class="fa-solid fa-xmark"></i>
                                        لغو کردن
                                    </a>
                                    <a href="{{ route('admin.market.payment.refund', $payment->id) }}"
                                        class="btn bg-red-500 text-white dark:bg-red-400 dark:text-black flex-center gap-1">
                                        <i class="fa-solid fa-share"></i>
                                        برگشت وجه
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
