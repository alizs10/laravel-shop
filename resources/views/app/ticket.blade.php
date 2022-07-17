@extends('app.layouts.master')

@section('content')
    <!-- breadcrumb starts-->
    <section
        class="px-2 py-4 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white flex flex-wrap items-center gap-1 md:gap-2">

        <a href="" class="text-xs xs:text-sm md:text-base text-red-500">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs xs:text-sm md:text-base text-red-500">پروفایل</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="" class="text-xs xs:text-sm md:text-base text-red-500">تیکت های شما</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs xs:text-sm md:text-base text-red-500">مشاهده تیکت</span>


    </section>
    <!-- breadcrumb ends -->

    <!-- ticket single show starts -->
    <section class="bg-gray-100 dark:bg-gray-800 rounded-lg p-3 mt-4">
        <div class="flex flex-col gap-3">
            <div class="flex justify-between gap-x-8 items-start">
                <span class="flex gap-x-2 items-start text-lg text-gray-500 dark:text-gray-400">
                    <i class="fa-solid fa-tag mt-1"></i>
                    <span>{{ $ticket->subject }}</span>
                </span>
                <a href="" class="mt-1 text-gray-500 dark:text-gray-400 text-xs xs:text-base md:text-xs">
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

            <p class="text-xs xs:text-sm text-justify leading-6 xs:leading-7">
                {{ $ticket->description }}
            </p>

            @if ($ticket->children->count() > 0)
                @foreach ($ticket->children as $ticket_child)
                    @if ($ticket->reference_id == $ticket_child->author_id)
                        <span class="text-xs bg-red-500 text-white p-2 rounded-lg flex gap-x-2 items-center md:w-fit">
                            <i class="fa-solid fa-reply text-base"></i>
                            <span>پاسخ ادمین</span>
                        </span>
                    @else
                        <span
                            class="text-xs bg-gray-200 dark:bg-gray-700 p-2 rounded-lg flex gap-x-2 items-center md:w-fit">
                            <i class="fa-solid fa-reply text-base"></i>
                            <span>پاسخ شما</span>
                        </span>
                    @endif

                    <p class="text-xs xs:text-sm text-justify leading-6 xs:leading-7">
                        {{ $ticket_child->description }}
                    </p>
                @endforeach
            @endif

            @if ($ticket->status == 1)
                <span
                    class="text-xs bg-white dark:bg-gray-700 text-emerald-600 dark:text-emerald-500 p-2 rounded-lg flex gap-x-2 items-center md:w-fit">
                    <span class="w-4 h-4 rounded-full bg-emerald-600 dark:bg-emerald-500 flex-center text-white">
                        <i class="fa-regular fa-check text-sm"></i>
                    </span>
                    <span>تیکت بسته شد</span>
                </span>
            @else
                <span class="text-xxs bg-gray-200 dark:bg-gray-700 p-2 rounded-lg md:w-fit">
                    در انتظار پاسخ
                </span>
            @endif

        </div>


    </section>
    <!-- ticket single show ends -->
@endsection
