@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | ایجاد روش ارسال جدید</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.market.delivery.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">روش های ارسال</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">ایجاد روش ارسال جدید</span>

    </section>
@endsection
@section('content')

<section class="flex flex-col gap-y-2 p-2 w-full">
        
    <div class="flex justify-between items-center">
        <span class="text-sm md:text-lg">ایجاد روش ارسال جدید</span>
        <a href="{{ route('admin.market.delivery.index') }}" class="btn bg-blue-600 text-white">بازگشت</a>
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


    <form class="w-full" action="{{ route('admin.market.delivery.store') }}" method="POST"
        enctype="multipart/form-data" id="form">
        @csrf

        <section class="w-full grid grid-cols-2 gap-2">
            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="name"
                    class="text-xs {{ $errors->has('name') ? 'text-red-600 dark:text-red-400' : '' }}">نام روش ارسال</label>
                <input type="text" class="form-input" name="name" id="name"
                    value="{{ old('name') }}">
            </div>
            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="amount"
                    class="text-xs {{ $errors->has('amount') ? 'text-red-600 dark:text-red-400' : '' }}">هزینه ارسال</label>
                <input type="text" class="form-input" name="amount" id="amount"
                    value="{{ old('amount') }}">
            </div>
            
            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="delivery_time"
                    class="text-xs {{ $errors->has('delivery_time') ? 'text-red-600 dark:text-red-400' : '' }}">زمان ارسال</label>
                <input type="text" class="form-input" name="delivery_time" id="delivery_time"
                    value="{{ old('delivery_time') }}">
            </div>
            
            <div class="col-span-2 md:col-span-1 flex flex-col gap-y-1">
                <label for="delivery_time_unit"
                    class="text-xs {{ $errors->has('delivery_time_unit') ? 'text-red-600 dark:text-red-400' : '' }}">واحد زمان ارسال</label>
                <input type="text" class="form-input" name="delivery_time_unit" id="delivery_time_unit"
                    value="{{ old('delivery_time_unit') }}">
            </div>
        
            
            <div class="col-span-2  flex flex-col gap-y-1">
                <label for="status"
                    class="text-xs {{ $errors->has('status') ? 'text-red-600 dark:text-red-400' : '' }}">وضعیت</label>
                <select name="status" id="status" class="form-select" style="direction: ltr">
                    <option value="1" @if (old('status') == 1) selected @endif>فعال</option>
                    <option value="0" @if (old('status') == 0) selected @endif>غیرفعال</option>
                </select>
            </div>
            

            <button class="col-span-2 py-2 rounded-lg bg-emerald-600 text-white text-sm md:text-base">ثبت</button>
        </section>
    </form>
</section>
  
@endsection
