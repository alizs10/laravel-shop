@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش کاربران | تعیین نقش ادمین</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش کاربران</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.user.admin-user.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">ادمین ها</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">تعیین نقش ادمین</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">تعیین نقش ادمین</span>
            <a href="{{ route('admin.user.admin-user.index') }}" class="btn bg-blue-600 text-white">بازگشت</a>

        </div>


        <section class="w-full">

            <div class="flex justify-between rounded-lg p-2 bg-emerald-400 text-black text-sm">
                <span>نام: {{ $admin->fullName }}</span>
                <span>ایمیل: {{ $admin->email }}</span>
            </div>

            <form class="w-full" action="{{ route('admin.user.admin-user.set-role', $admin->id) }}" method="POST"
                enctype="multipart/form-data" id="form">
                @csrf

                <section class="w-full grid grid-cols-2 gap-2">

                    <div class="col-span-2 mt-2 text-gray-500 text-base">نقش ها</div>

                    <div class="grid grid-cols-4 gap-2">
                        @foreach ($roles as $role)
                            <div class="col-span-2 md:col-span-1">
                                <input type="checkbox" name="role_id[]" value="{{ $role->id }}"
                                    id="role-{{ $role->id }}"
                                    {{ in_array($role->id, $adminRolesIdArray) ? 'checked' : '' }}>
                                <label class="text-sm" for="role-{{ $role->id }}">{{ $role->name }}</label>

                            </div>
                        @endforeach
                    </div>

                    <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
                </section>
            </form>
        </section>


    </section>
@endsection
