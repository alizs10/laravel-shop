@extends('auth.layouts.master')

@section('content')
<section class="grid grid-rows-6 h-screen">
    <div class="row-span-1"></div>
    <div class="row-span-3 flex flex-col justify-center mb-10">
        <div class="flex flex-col gap-y-4">
            <i class="fa-duotone fa-bag-shopping text-red-500 text-9xl"></i>
            <span class="text-center font-bold text-2xl md:text-3xl dark:text-white">فروشگاه اینترنتی لاراول</span>
        </div>

        <button href=""
            class="btn mt-4 bg-white dark:bg-gray-600 dark:text-gray-100 w-3/4 lg:w-2/5 flex self-center justify-between items-center">
            <span class="text-xs lg:text-sm">ورود با گوگل</span>
            <img src="{{ asset('app-assets/images/google.svg') }}" class="w-6" alt="">
        </button>

        <form class="flex flex-col w-3/4 lg:w-2/5 mt-4 self-center" action="">
            <label class="text-xs text-gray-500 mb-2" for="">ایمیل</label>
            <input type="email" name="email"
                class="form-control block w-full px-3 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none"
                id="exampleFormControlInput1" placeholder="abc@example.com" />

            <button class="btn bg-red-500 text-white mt-2">ورود</button>
        </form>

     
    </div>



</section>
@endsection