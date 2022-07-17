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
        <div id="tickets-section"
            class="lg:block col-span-9 lg:col-span-7 lg:h-fit flex flex-col gap-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">

            <span class="flex justify-between items-center">
                <span class="flex items-center gap-3">
                    <button onclick="profileBack()" class="lg:hidden text-lg">
                        <i class="fa fa-arrow-right"></i>
                    </button>
                    <span class="text-sm xs:text-base text-gray-500 dark:text-gray-400">
                        تیکت های شما
                    </span>
                </span>
                <button onclick="toggleAddNewTicket()"
                    class="px-3 py-2 text-xs flex-center rounded-lg bg-red-500 text-white">
                    <span>ثبت تیکت</span>
                </button>
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
@section('add-to-body')
    <!-- add new ticket modal starts -->
    <div id="new-ticket-backdrop" onclick="toggleAddNewTicket()"
        class="hidden fixed top-0 bottom-0 left-0 right-0 bg-gray-500/70 z-40 transition-all duration-300">
        <form class="w-full flex-center" action="">
            <div class="w-5/6 md:w-2/3 rounded-lg p-3 shadow-md bg-white dark:bg-gray-700 flex flex-col gap-y-3"
                onclick="event.stopPropagation()">
                <div class="flex justify-between">
                    <span class="text-red-500 text-xs xs:text-base md:text-lg">ثبت تیکت جدید</span>
                    <button type="button" onclick="toggleAddNewTicket()">
                        <i class="fa-solid fa-xmark text-xl md:text-2xl"></i>
                    </button>
                </div>
                <div class="w-full max-h-[calc(100vh_-_14rem)] overflow-y-scroll no-scrollbar grid grid-cols-2 gap-2">
                    <div class="col-span-2 md:col-span-1 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2" for="">انتخاب
                            دسته</label>
                        <select class="form-input" name="" id="">
                            <option class="text-black" value="">مشکل در خرید</option>
                            <option class="text-black" value="">پیشنهاد</option>
                            <option class="text-black" value="">سوال</option>
                        </select>
                    </div>
                    <div class="col-span-2 md:col-span-1 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2" for="">
                            اولویت تیکت
                        </label>
                        <select class="form-input" name="" id="">
                            <option class="text-black" value="">مهم</option>
                            <option class="text-black" value="">متوسط</option>
                            <option class="text-black" value="">کم اهمیت</option>
                        </select>
                    </div>
                    <div class="col-span-2 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2" for="">موضوع
                            تیکت</label>
                        <input type="text" class="form-input" name="" id="" />
                    </div>
                    <div class="col-span-2 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2"
                            for="">توضیحات
                            تیکت</label>
                        <textarea class="form-input" name="" id="" rows="3"
                            placeholder="توضیحات خود را کامل بنویسید"></textarea>
                    </div>


                </div>

                <button type="submit"
                    class="w-full bg-red-500 text-white text-sm text-center md:text-base py-3 rounded-lg">ارسال
                    تیکت</button>
            </div>
        </form>

    </div>
    <!-- add new ticket modal ends -->
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('app-assets/js/tickets-page.js') }}"></script>
@endsection
