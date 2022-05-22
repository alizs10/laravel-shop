@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | تیکت ها | ادمین تیکت ها | افزودن ادمین جدید</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش تیکت ها</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.ticket.admin.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">ادمین تیکت ها</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">افزودن ادمین جدید</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">افزودن ادمین جدید</span>
            <a href="{{ route('admin.ticket.admin.index') }}" class="btn bg-blue-600 text-white">بازگشت</a>
        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($admins as $admin)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->fullName }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <span class="flex items-center gap-x-1">

                                    <button data-url="{{ route('admin.ticket.admin.set', $admin->id) }}"
                                        onclick="changeTicketAdmin({{ $admin->id }})" id="admin-{{ $admin->id }}"
                                        class="btn {{ $admin->ticketAdmin ? 'bg-red-400' : 'bg-emerald-400' }} text-black flex-center gap-1">
                                        @if ($admin->ticketAdmin)
                                            <i class="fa-solid fa-user-minus"></i>
                                        @else
                                            <i class="fa-solid fa-user-check"></i>
                                        @endif

                                        <span>
                                            {{ $admin->ticketAdmin ? 'حذف وظیفه' : 'اعمال وظیفه' }}
                                        </span>
                                    </button>

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
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-ticket-admin.js') }}"></script>
@endsection
