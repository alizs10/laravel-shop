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


            <form class="flex flex-col w-3/4 lg:w-2/5 mt-4 self-center" action="{{ route('auth.change-password') }}"
                method="POST">
                @csrf
                <label class="text-xs text-gray-500 mb-2" for="old_password">کلمه عبور فعلی</label>
                <input type="password" name="old_password"
                    class="form-control block w-full px-3 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />

                <label class="text-xs text-gray-500 mb-2" for="password">کلمه عبور جدید</label>
                <input type="password" name="password"
                    class="form-control block w-full px-3 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />

                <label class="mt-2 text-xs text-gray-500 mb-2" for="password_confirmation">تکرار کلمه عبور جدید</label>
                <input type="password" name="password_confirmation"
                    class="form-control block w-full px-3 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />

                <button type="submit" class="btn bg-red-500 text-white mt-2">تغییر کلمه عبور</button>
            </form>

        </div>



    </section>

@endsection
