@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش کاربران | سطوح دسترسی | ویرایش دسترسی های نقش</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش کاربران</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.user.role.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">سطوح دسترسی</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">ویرایش دسترسی های نقش</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">ویرایش دسترسی های نقش</span>
            <a href="{{ route('admin.user.role.index') }}" class="btn bg-blue-600 text-white">بازگشت</a>

        </div>

        @if ($errors->any())
            <div class="flex flex-col gap-y-1 rounded-lg bg-red-200 p-2">
                <span class="text-xs">خطا های فرم:</span>
                @foreach ($errors->all() as $error)
                    <div class="flex gap-x-1 text-red-600 items-center">
                        <span class="text-base">
                            <i class="fa-light fa-diamond-exclamation"></i>
                        </span>
                        <span class="text-sm">{{ $error }}</span>
                    </div>
                @endforeach

            </div>
        @endif
        <section class="w-full">

            <div class="flex flex-col gap-y-2 rounded-lg p-2 bg-emerald-400 text-black text-sm">
                <span>نقش: {{ $role->name }}</span>
                <span>توضیح نقش: {{ $role->description }}</span>
            </div>

            <form class="w-full" action="{{ route('admin.user.permission.update', $role->id) }}" method="POST"
                enctype="multipart/form-data" id="form">
                @csrf
                @method('put')
                <section class="w-full flex flex-col gap-y-2">

                    <div class="mt-2 text-gray-500 text-base">دسترسی ها</div>

                    <div class="grid grid-cols-4 gap-2">
                        @foreach ($permissions as $permission)
                            <div class="col-span-2 md:col-span-1">
                                <input type="checkbox" name="permission_id[]" value="{{ $permission->id }}"
                                    id="permission-{{ $permission->id }}"
                                    {{ in_array($permission->id, $permissionsRoleIDsArray) ? 'checked' : '' }}>
                                <label class="w-100"
                                    for="permission-{{ $permission->id }}">{{ $permission->name }}</label>

                            </div>
                        @endforeach
                    </div>

                    <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
                </section>
            </form>
        </section>


    </section>
@endsection
