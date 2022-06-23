@extends('app.layouts.master')

@section('content')
    <!-- breadcrumb starts-->
    <section
        class="px-2 py-4 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white flex flex-wrap items-center gap-1 md:gap-2">

        <a href="" class="text-xs xs:text-sm md:text-base text-red-500">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs xs:text-sm md:text-base text-red-500">پروفایل</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs xs:text-sm md:text-base text-red-500">مشخصات کاربری</span>


    </section>
    <!-- breadcrumb ends -->

    <!-- profile starts -->
    <section class="grid grid-cols-9 gap-4 mt-4">

        <div id="profile-section"
            class="hidden lg:block col-span-9 lg:col-span-2 flex flex-col gap-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">
            <span class="flex items-center gap-2 text-xs xs:text-base">

                <span class="text-gray-500 dark:text-gray-400">
                    پروفایل
                </span>
            </span>

            <ul class="flex flex-col gap-4 xs:gap-y-4 py-3 mx-2 mt-2">
                <li>
                    <button onclick="profileBack()" class="flex items-center gap-3 py-2 text-red-500">
                        <i class="fa-light fa-user text-sm xs:text-2xl"></i>
                        <span class="text-xs xs:text-base">
                            مشخصات کاربری
                        </span>
                    </button>
                </li>
                <li>
                    <button class="flex items-center gap-3 py-2">
                        <i class="fa-light fa-list-alt text-sm xs:text-2xl"></i>
                        <span class="text-xs xs:text-base">
                            لیست سفارشات
                        </span>
                    </button>
                </li>
                <li>
                    <button class="flex items-center gap-3 py-2">
                        <i class="fa-light fa-heart text-sm xs:text-2xl"></i>
                        <span class="text-xs xs:text-base">
                            لیست علاقه مندی ها
                        </span>
                    </button>
                </li>
                <li>
                    <button class="flex items-center gap-3 py-2">
                        <i class="fa-light fa-map-location text-sm xs:text-2xl"></i>
                        <span class="text-xs xs:text-base">
                            آدرس های شما
                        </span>
                    </button>
                </li>
                <li>
                    <button class="flex items-center gap-3 py-2">
                        <i class="fa-light fa-right-from-bracket text-sm xs:text-2xl"></i>
                        <span class="text-xs xs:text-base">
                            خروج از حساب کاربری
                        </span>
                    </button>
                </li>
            </ul>

        </div>
        <div
            class=" lg:block col-span-9 lg:col-span-7 lg:h-fit flex flex-col gap-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">
            <span class="flex items-center gap-3">
                <button onclick="profileBack()" class="lg:hidden text-lg">
                    <i class="fa fa-arrow-right"></i>
                </button>
                <span class="text-sm xs:text-base text-gray-500 dark:text-gray-400">
                    مشخصات کاربری
                </span>
            </span>

            <div class="grid grid-cols-2 gap-2 mt-2">
                <div
                    class="col-span-2 md:col-span-1 flex gap-2 text-xs border-b-2 border-gray-300 dark:border-gray-700 p-3">
                    <span>نام:</span>
                    <span>{{ $user->first_name }}</span>
                </div>
                <div
                    class="col-span-2 md:col-span-1 flex gap-2 text-xs border-b-2 border-gray-300 dark:border-gray-700 p-3">
                    <span>نام خانوادگی:</span>
                    <span>{{ $user->last_name }}</span>
                </div>
                <div
                    class="col-span-2 md:col-span-1 flex gap-2 text-xs border-b-2 border-gray-300 dark:border-gray-700 p-3">
                    <span>کد ملی:</span>
                    <span>{{ $user->national_code }}</span>
                </div>
                <div
                    class="col-span-2 md:col-span-1 flex gap-2 text-xs border-b-2 border-gray-300 dark:border-gray-700 p-3">
                    <span>ایمیل:</span>
                    <span>{{ $user->email }}</span>
                </div>
                <div
                    class="col-span-2 md:col-span-1 flex gap-2 text-xs border-b-2 border-gray-300 dark:border-gray-700 p-3">
                    <span>شماره تلفن:</span>
                    <span>{{ $user->mobile }}</span>
                </div>
                <div
                    class="col-span-2 md:col-span-1 flex gap-2 text-xs border-b-2 border-gray-300 dark:border-gray-700 p-3">
                    <span>تاریخ تولد:</span>
                    <span>--</span>
                </div>
                <div
                    class="col-span-2 md:col-span-1 flex justify-between text-xs border-b-2 border-gray-300 dark:border-gray-700 p-3">
                    <span>کلمه عبور:</span>
                    <a href="" class="text-blue-600 dark:text-blue-500">تغییر کلمه عبور</a>
                </div>

                <div class="col-span-2 mt-4">
                    <button onclick="toggleEditUserInfos()"
                        class="w-full lg:w-fit lg:px-4 col-span-2 flex-center gap-2 rounded-lg bg-yellow-300 text-black py-3 text-center text-xs">
                        <i class="fa-regular fa-edit"></i>
                        <span>ویرایش اطلاعات</span>
                    </button>
                </div>

            </div>

        </div>

    </section>
    <!-- profile ends -->
@endsection

@section('add-to-body')
    <!-- edit user infos modal starts -->
    <div id="edit-user-infos-backdrop" onclick="toggleEditUserInfos()"
        class="hidden fixed top-0 bottom-0 left-0 right-0 bg-gray-500/70 z-40 transition-all duration-300">
        <form class="w-full flex-center" action="{{ route('app.user.profile.update', $user) }}" method="POST">
            @csrf
            @method('put')
            <div class="w-5/6 md:w-2/3 rounded-lg p-3 shadow-md bg-white dark:bg-gray-700 flex flex-col gap-y-3"
                onclick="event.stopPropagation()">
                <div class="flex justify-between">
                    <span class="text-red-500 text-xs xs:text-base md:text-lg">ثبت آدرس جدید</span>
                    <button type="button" onclick="toggleEditUserInfos()">
                        <i class="fa-solid fa-xmark text-xl md:text-2xl"></i>
                    </button>
                </div>
                <div class="w-full max-h-[calc(100vh_-_14rem)] overflow-y-scroll no-scrollbar grid grid-cols-2 gap-2">

                    <div class="col-span-2 md:col-span-1 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2"
                            for="">نام</label>
                        <input type="text" class="form-input" name="first_name" id="first_name"
                            value="{{ old('first_name', $user->first_name) }}" />
                        @if ($errors->has('first_name'))
                            <span class="text-xs text-red-500">{{ $errors->first('first_name') }}</span>
                        @endif
                    </div>
                    <div class="col-span-2 md:col-span-1 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2" for="">نام
                            خانوادگی</label>
                        <input type="text" class="form-input" name="last_name" id="last_name"
                            value="{{ old('last_name', $user->last_name) }}" />
                        @if ($errors->has('last_name'))
                            <span class="text-xs text-red-500">{{ $errors->first('last_name') }}</span>
                        @endif
                    </div>
                    <div class="col-span-2 md:col-span-1 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2"
                            for="">ایمیل</label>
                        <input type="email" class="form-input" name="email" id="email"
                            value="{{ old('email', $user->email) }}" />
                        @if ($errors->has('email'))
                            <span class="text-xs text-red-500">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="col-span-2 md:col-span-1 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2" for="">شماره
                            موبایل</label>
                        <input type="text" class="form-input" name="mobile" id="mobile"
                            value="{{ old('mobile', $user->mobile) }}" />
                        @if ($errors->has('mobile'))
                            <span class="text-xs text-red-500">{{ $errors->first('mobile') }}</span>
                        @endif
                    </div>
                    <div class="col-span-2 md:col-span-1 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2" for="">
                            کدملی
                        </label>
                        <input type="text" class="form-input" name="national_code" id="national_code"
                            value="{{ old('national_code', $user->national_code) }}" />
                        @if ($errors->has('national_code'))
                            <span class="text-xs text-red-500">{{ $errors->first('national_code') }}</span>
                        @endif
                    </div>
                    <div class="col-span-2 md:col-span-1 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2" for="">
                            تاریخ تولد
                        </label>
                        <input type="text" class="form-input" name="" id="" />
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-red-500 text-white text-sm text-center md:text-base py-3 rounded-lg">ثبت
                    مشخصات</button>
            </div>
        </form>

    </div>
    <!-- edit user infos modal ends -->
@endsection

@section('scripts')
    <script src="{{ asset('app-assets/js/profile-page.js') }}"></script>
    @if ($errors->any())
        <script>
            toggleEditUserInfos();
        </script>
    @endif
@endsection
