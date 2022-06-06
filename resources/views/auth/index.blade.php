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
            @else
                @if ($message)
                    <span class="text-center text-red-500 mt-4">{{ $message }}</span>>
                @endif
            @endif


            @if ($user == 'true')
                @include('auth.set-password-form')
            @else
                @if ($vcode == 'true')
                    @include('auth.vcode-form')
                @elseif($code == 'checked')
                    @include('auth.set-passwords-form')
                @else
                    @include('auth.login-form')
                @endif
            @endif




        </div>



    </section>
@endsection
