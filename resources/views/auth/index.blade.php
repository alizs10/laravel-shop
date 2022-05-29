@extends('auth.layouts.master')

@section('content')
    <section class="grid grid-rows-6 h-screen">
        <div class="row-span-1"></div>
        <div class="row-span-3 flex flex-col justify-center mb-10">
            <div class="flex flex-col gap-y-4">
                <i class="fa-duotone fa-bag-shopping text-red-500 text-9xl"></i>
                <span class="text-center font-bold text-2xl md:text-3xl dark:text-white">فروشگاه اینترنتی لاراول</span>
            </div>

            @if ($errors->any())
                <div class="flex flex-col gap-y-1 w-3/4 lg:w-2/5 mt-4 self-center">

                    @foreach ($errors->all() as $error)
                        <div class="flex-center gap-x-1 text-red-500">
                            <span class="text-base">
                                <i class="fa-light fa-diamond-exclamation"></i>
                            </span>
                            <span class="text-sm">{{ $error }}</span>
                        </div>
                    @endforeach

                </div>
            @endif
            @if (session()->get('message'))
                <span class="text-center text-red-500 mt-4">{{ session()->get('message') }}</span>>
            @endif

            @if ($user_login_status === "true")
                <form class="flex flex-col w-3/4 lg:w-2/5 mt-4 self-center" action="{{ route('auth.login') }}"
                    method="POST">
                    @csrf
                    <label class="text-xs text-gray-500 mb-2" for="password">کلمه عبور</label>
                    <input type="password" name="password"
                        class="form-control block w-full px-3 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />
                    <input type="hidden" name="email" value="{{ request()->get('email') }}" />

                    <button type="submit" class="btn bg-red-500 text-white mt-2">ورود</button>
                </form>
            @else
                @if (request()->get('vcode') == 1)
                    <form class="flex flex-col w-3/4 lg:w-2/5 mt-4 self-center"
                        action="{{ route('auth.check-verification-code') }}" method="POST">
                        @csrf
                        <label class="text-xs text-gray-500 dark:text-gray-100 mb-2" for="">کد تایید</label>
                        <div class="grid grid-cols-6 gap-x-2" style="direction:ltr">
                            <input type="text" maxlength="1" name="vcode[]"
                                class="col-span-1 text-center form-control block w-full px-1 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />
                            <input type="text" maxlength="1" name="vcode[]"
                                class="col-span-1 text-center form-control block w-full px-1 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />
                            <input type="text" maxlength="1" name="vcode[]"
                                class="col-span-1 text-center form-control block w-full px-1 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />
                            <input type="text" maxlength="1" name="vcode[]"
                                class="col-span-1 text-center form-control block w-full px-1 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />
                            <input type="text" maxlength="1" name="vcode[]"
                                class="col-span-1 text-center form-control block w-full px-1 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />
                            <input type="text" maxlength="1" name="vcode[]"
                                class="col-span-1 text-center form-control block w-full px-1 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />

                        </div>
                        <input type="hidden" name="email" value="{{ request()->get('email') }}" />

                        <button type="submit" class="btn bg-red-500 text-white mt-2">تایید</button>

                    </form>
                @elseif(request()->get('vcode') == 2)
                    <form class="flex flex-col w-3/4 lg:w-2/5 mt-4 self-center" action="{{ route('auth.set-password') }}"
                        method="POST">
                        @csrf
                        <label class="text-xs text-gray-500 mb-2" for="password">کلمه عبور</label>
                        <input type="password" name="password"
                            class="form-control block w-full px-3 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />
                        <input type="hidden" name="email" value="{{ request()->get('email') }}" />
                        <label class="mt-2 text-xs text-gray-500 mb-2" for="password_confirmation">تکرار کلمه عبور</label>
                        <input type="password" name="password_confirmation"
                            class="form-control block w-full px-3 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />
                        <input type="hidden" name="email" value="{{ request()->get('email') }}" />
                        <input type="hidden" name="token" value="{{ request()->get('token') }}" />

                        <button type="submit" class="btn bg-red-500 text-white mt-2">ثبت نام</button>
                    </form>
                @else
                    <button href=""
                        class="btn mt-4 bg-white dark:bg-gray-600 dark:text-gray-100 w-3/4 lg:w-2/5 flex self-center justify-between items-center">
                        <span class="text-xs lg:text-sm">ورود با گوگل</span>
                        <img src="{{ asset('app-assets/images/google.svg') }}" class="w-6" alt="">
                    </button>

                    <form class="flex flex-col w-3/4 lg:w-2/5 mt-4 self-center" action="{{ route('auth.check-email') }}"
                        method="POST">
                        @csrf
                        <label class="text-xs text-gray-500 mb-2" for="">ایمیل</label>
                        <input type="email" name="email"
                            class="form-control block w-full px-3 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none"
                            placeholder="abc@example.com" />

                        <button type="submit" class="btn bg-red-500 text-white mt-2">ورود</button>
                    </form>
                @endif
            @endif




        </div>



    </section>
@endsection
