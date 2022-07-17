@extends('app.layouts.master')

@section('content')
    <!-- breadcrumb starts-->
    <section
        class="px-2 py-4 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white flex flex-wrap items-center gap-1 md:gap-2">

        <a href="" class="text-xs xs:text-sm md:text-base text-red-500">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs xs:text-sm md:text-base text-red-500">پروفایل</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs xs:text-sm md:text-base text-red-500">تیکت های شما</span>


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
                    <button class="flex items-center gap-3 py-2 ">
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
                    <button onclick="profileBack()" class="flex items-center gap-3 py-2 text-red-500">
                        <i class="fa-light fa-ticket text-sm xs:text-2xl"></i>
                        <span class="text-xs xs:text-base">
                            تیکت های شما
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
            class="lg:block col-span-9 lg:col-span-7 lg:h-fit flex flex-col gap-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">
            <span class="flex items-center gap-3">
                <button onclick="profileBack()" class="lg:hidden text-lg">
                    <i class="fa fa-arrow-right"></i>
                </button>
                <span class="text-sm xs:text-base text-gray-500 dark:text-gray-400">
                    تیکت های شما
                </span>
            </span>

            <div class="flex flex-col gap-y-2 mt-2">
                <div class="flex flex-col gap-2 pb-2">

                    @if ($tickets->count() > 0)
                        @foreach ($tickets as $tikcet)
                            <div class="rounded-lg border border-gray-300 dark:border-gray-700 p-2 flex flex-col gap-y-3">
                                <div class="flex justify-between items-center">
                                    <div class="flex gap-x-2 items-center">
                                        @if ($ticket->status == 1)
                                            <span class="w-4 h-4 rounded-full bg-emerald-600 flex-center text-white">
                                                <i class="fa-regular fa-check text-sm"></i>
                                            </span>
                                        @else
                                            <span class="w-4 h-4 rounded-full bg-gray-500 dark:bg-gray-400"></span>
                                        @endif

                                        <a href="{{ route('app.user.ticket.show-ticket', $ticket->id) }}"
                                            class="text-base underline underline-offset-4 text-gray-500 dark:text-gray-400">
                                            {{ $ticket->subject }}
                                        </a>
                                    </div>

                                    <a href=""
                                        class="text-gray-500 dark:text-gray-400 text-xs xs:text-base md:text-xs">
                                        <i class="fa-regular fa-trash-alt"></i>
                                    </a>
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    <span class="text-xxs bg-gray-200 dark:bg-gray-700 p-2 rounded-lg w-fit">
                                        {{ e2p_numbers(showPersianDate($ticket->create_at)) }}
                                    </span>
                                    <span
                                        class="text-xxs bg-gray-200 dark:bg-gray-700 p-2 rounded-lg w-fit">{{ $ticket->priority->name }}</span>
                                    <span class="text-xxs bg-gray-200 dark:bg-gray-700 p-2 rounded-lg w-fit">
                                        @if ($ticket->status == 1)
                                            بسته شده
                                        @else
                                            در انتظار پاسخ
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="flex-center gap-x-2 text-lg text-gray-500 dark:text-gray-400">
                            <i class="fa-light fa-circle-exclamation text-2xl"></i>
                            <span>تیکتی برای نمایش وجود ندارد</span>
                        </div>
                    @endif


                </div>


            </div>

        </div>

    </section>
    <!-- profile ends -->
@endsection
