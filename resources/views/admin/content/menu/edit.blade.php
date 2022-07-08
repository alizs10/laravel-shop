@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | ویرایش منو</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش محتوی</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.content.menu.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">منو ها</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">ویرایش منو</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">

        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">ویرایش منو</span>
            <a href="{{ route('admin.content.menu.index') }}" class="btn bg-blue-600 text-white">بازگشت</a>
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


        <form class="w-full" action="{{ route('admin.content.menu.update', $menu->id) }}" method="POST"
            enctype="multipart/form-data" id="form">
            @csrf
            @method('put')
            <section class="w-full grid grid-cols-2 gap-2">
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="name"
                        class="text-xs {{ $errors->has('name') ? 'text-red-600 dark:text-red-400' : '' }}">نام منو</label>
                    <input type="text" class="form-input" name="name" id="name"
                        value="{{ old('name', $menu->name) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="icon"
                        class="text-xs {{ $errors->has('icon') ? 'text-red-600 dark:text-red-400' : '' }}">آیکون منو</label>
                    <input type="text" class="form-input" name="icon" id="icon"
                        value="{{ old('icon', $menu->icon) }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="slug"
                        class="text-xs {{ $errors->has('slug') ? 'text-red-600 dark:text-red-400' : '' }}">اسلاگ</label>
                    <input type="text" class="form-input" name="slug" id="slug"
                        value="{{ old('slug') }}">
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="parent_id"
                        class="text-xs {{ $errors->has('parent_id') ? 'text-red-600 dark:text-red-400' : '' }}">منوی
                        والد</label>
                    <select name="parent_id" id="parent_id" class="form-select" style="direction: ltr">
                        <option value="">در صورت تمایل یک منو را انتخاب کنید</option>
                        @foreach ($menus as $parent_menu)
                            <option value="{{ $parent_menu->id }}" @if(old('parent_id', $menu->parent_id) == $parent_menu->id) selected @endif>
                                {{ $parent_menu->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                    <label for="status"
                        class="text-xs {{ $errors->has('status') ? 'text-red-600 dark:text-red-400' : '' }}">وضعیت</label>
                    <select name="status" id="status" class="form-select" style="direction: ltr">
                        <option value="1" @if (old('status', $menu->status) == 1) selected @endif>فعال</option>
                        <option value="0" @if (old('status', $menu->status) == 0) selected @endif>غیرفعال</option>
                    </select>
                </div>

                <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
            </section>
        </form>
    </section>
@endsection
