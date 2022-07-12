<header class="bg-slate-100 dark:bg-slate-800 dark:text-white p-1 h-14 xs:h-20 m-2 rounded-lg shadow-md md:shadow-none">
    <div class="flex justify-between h-full">
        <div class="h-full flex items-center gap-x-2">
            <button class="md:hidden flex-center p-2 text-xl xs:text-2xl" id="toggleSidebar" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>

            <button id="user-popup-btn" onclick="userPopupToggle()"
                class="relative flex flex-col gap-y-2 btn hover:bg-slate-200 dark:hover:bg-slate-700 hover-transition">
                <span class="text-xs xs:text-sm">
                    علی سلیمانی
                    <span>
                        <i class="fa fa-angle-down text-xxs xs:text-xs"></i>
                    </span>
                </span>
                <span class="text-xxs xs:text-xs text-emerald-500">آنلاین</span>

                <div
                    class="hidden absolute right-0 top-14 xs:top-16 xs:mt-3 z-20 h-fit max-h-96 overflow-y-scroll no-scrollbar w-36 rounded-lg overflow-hidden shadow-md">
                    <ul class="w-full">

                        <li>
                            <a href=""
                                class="flex flex-col gap-y-2 py-2 bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-700 hover-transition">
                                <span class="flex gap-x-2 text-xs mr-2 items-center">
                                    <i class="fa-light fa-user"></i>
                                    پروفایل کاربری
                                </span>
                            </a>
                            <a href=""
                                class="flex flex-col gap-y-2 py-2 bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-700 hover-transition">
                                <span class="flex gap-x-2 text-xs mr-2 items-center">
                                    <i class="fa-light fa-gears"></i>
                                    تنظیمات
                                </span>
                            </a>
                            <a href=""
                                class="flex flex-col gap-y-2 py-2 bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-700 hover-transition">
                                <span class="flex gap-x-2 text-xs mr-2 items-center">
                                    <i class="fa-light fa-door-open"></i>
                                    خروج
                                </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </button>
        </div>
        <div class="flex gap-x-4 items-center">

            <button class="flex-center flex-col gap-y-2 text-xl xs:text-3xl relative px-3" id="toggleThemeBtn"
                onclick="toggleTheme()">
                <i class="fa-light fa-lightbulb-on dark:hidden"></i>
                <i class="fa-light fa-lightbulb-slash hidden dark:inline"></i>
                <span class="absolute top-4 xs:top-7 text-xxxs text-gray-500 hidden dark:inline">حالت شب</span>
                <span class="absolute top-4 xs:top-7 text-xxxs text-gray-500  dark:hidden">حالت روز</span>
            </button>

            <button id="alerts-popup-btn" onclick="alertsPopupToggle()"
                class="h-10 md:h-16 w-10 md:w-16 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-700 hover-transition relative">
                <i class="fa-light fa-bell text-xl xs:text-3xl"></i>
                @if (count($unreadNotifications) > 0)
                    <span
                        class="absolute bottom-0 -right-3 rounded-full bg-red-600 h-5 xs:h-7 w-5 xs:w-7 p-1 text-xxxs xs:text-xxs md:text-xs flex-center text-white">
                        {{ e2p_numbers($unreadNotifications->count()) }}
                    </span>
                @endif


                <div
                    class="hidden absolute -left-1 top-14 xs:top-20 z-20 h-fit max-h-96 overflow-y-scroll no-scrollbar w-56 rounded-lg overflow-hidden shadow-md">
                    <ul class="w-full">

                        @foreach ($unreadNotifications as $unreadNotification)
                            <li>
                                <a href=""
                                    class="flex flex-col gap-y-2 py-2 bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-700 hover-transition">
                                    <div class="flex justify-between mx-2">
                                        <span class="flex gap-x-2">
                                            <i class="fa fa-user"></i>
                                            <span class="text-xxs">
                                                {{ $unreadNotification['data']['username'] }}
                                            </span>
                                        </span>
                                        <span>
                                            <i
                                                class="fa-regular fa-dot-circle text-xxs xs:text-xs text-emerald-400"></i>
                                        </span>
                                    </div>
                                    <span class="text-right mr-2 text-xs text-blue-500 font-bold">
                                        {{ $unreadNotification['data']['message'] }}
                                    </span>
                                    <span class="mr-2 text-right text-gray-500 text-xxs">
                                        {{ Str::limit($unreadNotification['data']['title'], 35, '...') }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                        @if (count($unreadNotifications) == 0)
                            <li class="py-2 bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-700">
                                اعلان
                                جدیدی وجود ندارد
                                <li />
                        @endif

                    </ul>
                </div>
            </button>


            <button id="comments-popup-btn" onclick="commentsPopupToggle()"
                class="h-10 md:h-16 w-10 md:w-16 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-700 hover-transition relative">
                <i class="fa-light fa-message text-xl xs:text-3xl"></i>


                @if (count($unseenComments) > 0)
                    <span id="new-notifications-badge"
                        class="absolute bottom-0 -right-3 rounded-full bg-red-600 h-5 xs:h-7 w-5 xs:w-7 p-1 text-xxxs xs:text-xxs md:text-xs flex-center text-white">
                        {{ e2p_numbers(count($unseenComments)) }}
                    </span>
                @endif
                <div
                    class="hidden absolute -left-1 top-14 xs:top-20 z-20 h-fit max-h-96 overflow-y-scroll no-scrollbar w-56 rounded-lg overflow-hidden shadow-md">
                    <ul class="w-full">
                        @foreach ($unseenComments as $unseenComment)
                            <li>
                                <a href=""
                                    class="flex flex-col gap-y-2 py-2 bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-700 hover-transition">
                                    <div class="flex justify-between mx-2">
                                        <span class="flex gap-x-2">
                                            <i class="fa fa-user"></i>
                                            <span
                                                class="text-xs xs:text-sm">{{ $unseenComment->user->name ?? 'ناشناس' }}</span>
                                        </span>
                                        <span>
                                            <i
                                                class="fa-regular fa-dot-circle text-xxs xs:text-xs text-emerald-400"></i>
                                        </span>
                                    </div>

                                    <span class="mr-2 text-right text-gray-500 text-xxs xs:text-xs">
                                        {{ Str::limit($unseenComment->body, 15, '...') }}
                                    </span>
                                </a>
                            </li>
                        @endforeach

                        @if (count($unseenComments) == 0)
                            <li class="py-2 bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-700">
                                نظری
                                جدیدی وجود ندارد
                                <li />
                        @endif


                    </ul>
                </div>
            </button>

        </div>


    </div>
</header>
<script src="{{ asset('admin-assets/js/theme.js') }}"></script>