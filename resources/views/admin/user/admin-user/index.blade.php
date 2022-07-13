@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش کاربران | ادمین ها</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش کاربران</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">ادمین ها</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">ادمین ها</span>
            @can('create', \App\Models\User::class)
                <a href="{{ route('admin.user.admin-user.create') }}" class="btn bg-blue-600 text-white">افزودن ادمین جدید</a>
            @endcan
        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>شماره موبایل</th>
                        <th>نقش ها</th>
                        <th>وضعیت کاربر</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($admins as $admin)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->fullName }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->mobile }}</td>
                            <td class="flex flex-col">

                                @if (sizeof($admin->roles) !== 0)
                                    @foreach ($admin->roles as $num => $role)
                                        <div>
                                            {{ $num + 1 . '- ' . $role->name }}
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-danger">بدون نقش</p>
                                @endif
                            </td>
                            @can('update', \App\Models\User::class)
                                <td>
                                    <input type="checkbox" id="activation-{{ $admin->id }}"
                                        data-url="{{ route('admin.user.admin-user.activation', $admin->id) }}"
                                        onchange="changeActivation({{ $admin->id }})"
                                        @if ($admin->activation === 1) checked @endif>
                                </td>
                                <td>
                                    <input type="checkbox" id="status-{{ $admin->id }}"
                                        data-url="{{ route('admin.user.admin-user.status', $admin->id) }}"
                                        onchange="changeStatus({{ $admin->id }})"
                                        @if ($admin->status === 1) checked @endif>
                                </td>
                            @endcan

                            <td>
                                <span class="flex items-center gap-x-1">
                                    @can('index', \App\Models\User\Role::class)
                                        <a href="{{ route('admin.user.admin-user.roles', $admin->id) }}"
                                            class="btn bg-blue-600 text-white flex-center gap-1">
                                            <i class="fa-light fa-user-tag"></i>
                                            نقش
                                        </a>
                                    @endcan
                                    @can('update', \App\Models\User::class)
                                        <a href="{{ route('admin.user.admin-user.edit', $admin->id) }}"
                                            class="btn bg-yellow-500 text-black flex-center gap-1">
                                            <i class="fa-light fa-pen-to-square"></i>
                                            ویرایش
                                        </a>


                                        <form class="m-0"
                                            action="{{ route('admin.user.admin-user.destroy', $admin->id) }}" method="POST">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <button class="btn bg-red-400 text-black flex-center gap-1 delBtn">
                                                <i class="fa-light fa-trash-can"></i>
                                                حذف از لیست
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-status.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-activation.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
