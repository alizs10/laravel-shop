@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | مشتریان</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش کاربران</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">مشتریان</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">مشتریان</span>
            <a href="{{ route('admin.user.customer.create') }}" class="btn bg-blue-600 text-white">افزودن مشتری جدید</a>
        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>شماره موبایل</th>
                        <th>کد ملی</th>
                        <th>وضعیت کاربر</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($users as $user)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->fullName }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->mobile }}</td>
                            <td>{{ $user->national_code }}</td>
                            <td>
                                <input type="checkbox" id="activation-{{ $user->id }}"
                                    data-url="{{ route('admin.user.customer.activation', $user->id) }}"
                                    onchange="changeActivation({{ $user->id }})"
                                    @if ($user->activation === 1) checked @endif>
                            </td>
                            <td>
                                <input type="checkbox" id="status-{{ $user->id }}"
                                    data-url="{{ route('admin.user.customer.status', $user->id) }}"
                                    onchange="changeStatus({{ $user->id }})"
                                    @if ($user->status === 1) checked @endif>
                            </td>
                            <td>
                                <span class="flex items-center gap-x-1">


                                    <a href="{{ route('admin.user.customer.edit', $user->id) }}"
                                        class="btn bg-yellow-500 text-black flex-center gap-1">
                                        <i class="fa-light fa-pen-to-square"></i>
                                        ویرایش
                                    </a>
                                    <button data-url="{{ route('admin.user.customer.change-user-type', $user->id) }}"
                                        onclick="changeUserType({{ $user->id }})" id="user-{{ $user->id }}"
                                        class="btn {{ $user->type == 1 ? 'bg-red-400' : 'bg-emerald-400' }} text-black flex-center gap-1">
                                        @if ($user->type == 0)
                                        <i class="fa-solid fa-user-check"></i>
                                        @else
                                        <i class="fa-solid fa-user-minus"></i>
                                        @endif

                                        <span>
                                            {{ $user->type == 0 ? 'ادمین شو' : 'حذف ادمین' }}
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-status.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-activation.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-user-type.js') }}"></script>
@endsection
