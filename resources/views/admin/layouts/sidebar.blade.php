<aside id="sidebar" class="sidebar toggleSidebar md:fixed md:top-0 md:right-0 md:w-1/4">

    <div class="flex flex-col gap-y-2">
        <span class="text-purple-800 dark:text-purple-400 font-bold text-base xs:text-lg">پنل ادمین
            پیشرفته</span>

        <div class="mt-4 flex flex-col gap-y-4">
            <a href="{{ route('admin.home') }}" class="sidebar-link {{ sideBarMenuActiver(route('admin.home')) }}">
                <i class="fa-regular fa-house text-xl"></i>
                خانه
            </a>

            <span class="text-gray-500 text-xs">بخش فروش</span>

            <button class="sidebar-btn" onclick="toggleSidebarDropdownBtn(this)">

                <div class="flex justify-between w-full">
                    <span>
                        <i class="fa-regular fa-house text-xl"></i>
                        ویترین
                    </span>

                    <span class="angle ml-2 transition-all duration-300">
                        <i class="fa fa-angle-left"></i>
                    </span>
                </div>

                <ul class="hidden dropdown w-full mt-4 flex-col gap-y-2">
                    <a href="{{ route('admin.market.category.index') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4 hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            دسته بندی
                        </span>
                    </a>
                    <a href="{{ route('admin.market.property.index') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            فرم کالا
                        </span>
                    </a>
                    <a href="{{ route('admin.market.product.index') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            محصولات
                        </span>
                    </a>
                    <a href="{{ route('admin.market.brand.index') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            برند
                        </span>
                    </a>
                    <a href="{{ route('admin.market.store.index') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            انبار
                        </span>
                    </a>
                    <a href="{{ route('admin.market.comment.index') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            نظرات
                        </span>
                    </a>
                </ul>

            </button>
            <button class="sidebar-btn" onclick="toggleSidebarDropdownBtn(this)">

                <div class="flex justify-between w-full">
                    <span>
                        <i class="fa-regular fa-house text-xl"></i>
                        سفارشات
                    </span>

                    <span class="angle ml-2 transition-all duration-300">
                        <i class="fa fa-angle-left"></i>
                    </span>
                </div>

                <ul class="hidden dropdown w-full mt-4 flex-col gap-y-2">
                    <a href="{{ route('admin.market.order.newOrders') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4 hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            جدید
                        </span>
                    </a>
                    <a href="{{ route('admin.market.order.processing') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            در حال پردازش
                        </span>
                    </a>
                    <a href="{{ route('admin.market.order.delivering') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            در حال ارسال
                        </span>
                    </a>
                    <a href="{{ route('admin.market.order.unpaid') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            پرداخت نشده
                        </span>
                    </a>
                    <a href="{{ route('admin.market.order.expired') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            باطل شده
                        </span>
                    </a>
                    <a href="{{ route('admin.market.order.returned') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            مرجوعی
                        </span>
                    </a>
                    <a href="{{ route('admin.market.order.index') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            تمام سفارشات
                        </span>
                    </a>
                </ul>

            </button>
            <button class="sidebar-btn" onclick="toggleSidebarDropdownBtn(this)">

                <div class="flex justify-between w-full">
                    <span>
                        <i class="fa-regular fa-house text-xl"></i>
                        پرداخت ها
                    </span>

                    <span class="angle ml-2 transition-all duration-300">
                        <i class="fa fa-angle-left"></i>
                    </span>
                </div>

                <ul class="hidden dropdown w-full mt-4 flex-col gap-y-2">
                    <a href="{{ route('admin.market.payment.all') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4 hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            کل پرداخت ها
                        </span>
                    </a>
                    <a href="{{ route('admin.market.payment.online') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            پرداخت های آنلاین
                        </span>
                    </a>
                    <a href="{{ route('admin.market.payment.offline') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            پرداخت های آفلاین
                        </span>
                    </a>
                    <a href="{{ route('admin.market.payment.cash') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            پرداخت های در محل
                        </span>
                    </a>
                </ul>

            </button>
            <button class="sidebar-btn" onclick="toggleSidebarDropdownBtn(this)">

                <div class="flex justify-between w-full">
                    <span>
                        <i class="fa-regular fa-house text-xl"></i>
                        تخفیف ها
                    </span>

                    <span class="angle ml-2 transition-all duration-300">
                        <i class="fa fa-angle-left"></i>
                    </span>
                </div>

                <ul class="hidden dropdown w-full mt-4 flex-col gap-y-2">
                    <a href="{{ route('admin.market.discount.coupon') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4 hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            کوپن های تخفیف
                        </span>
                    </a>
                    <a href="{{ route('admin.market.discount.public') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            تخفیف های عمومی
                        </span>
                    </a>
                    <a href="{{ route('admin.market.discount.amazing') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            تخفیف های شگفت انگیز
                        </span>
                    </a>
                </ul>

            </button>


            <a href="{{ route('admin.market.delivery.index') }}"
                class="sidebar-link {{ sideBarMenuActiver(route('admin.market.delivery.index')) }}">
                <i class="fa-regular fa-house text-xl"></i>
                روش های ارسال
            </a>

            <span class="text-gray-500 text-xs">بخش محتوی</span>

            <a href="{{ route('admin.content.category.index') }}"
                class="sidebar-link {{ sideBarMenuActiver(route('admin.content.category.index')) }}">
                <i class="fa-regular fa-house text-xl"></i>
                دسته بندی
            </a>
            <a href="{{ route('admin.content.post.index') }}"
                class="sidebar-link {{ sideBarMenuActiver(route('admin.content.post.index')) }}">
                <i class="fa-regular fa-house text-xl"></i>
                پست ها
            </a>
            <a href="{{ route('admin.content.comment.index') }}"
                class="sidebar-link {{ sideBarMenuActiver(route('admin.content.comment.index')) }}">
                <i class="fa-regular fa-house text-xl"></i>
                نظرات
            </a>
            <a href="{{ route('admin.content.menu.index') }}"
                class="sidebar-link {{ sideBarMenuActiver(route('admin.content.menu.index')) }}">
                <i class="fa-regular fa-house text-xl"></i>
                منو
            </a>
            <a href="{{ route('admin.content.faq.index') }}"
                class="sidebar-link {{ sideBarMenuActiver(route('admin.content.faq.index')) }}">
                <i class="fa-regular fa-house text-xl"></i>
                سوالات متداول
            </a>
            <a href="{{ route('admin.content.page.index') }}"
                class="sidebar-link {{ sideBarMenuActiver(route('admin.content.page.index')) }}">
                <i class="fa-regular fa-house text-xl"></i>
                پیج ساز
            </a>

            <span class="text-gray-500 text-xs">بخش کاربران</span>

            <a href="{{ route('admin.user.admin-user.index') }}"
                class="sidebar-link {{ sideBarMenuActiver(route('admin.user.admin-user.index')) }}">
                <i class="fa-regular fa-house text-xl"></i>
                ادمین ها
            </a>
            <a href="{{ route('admin.user.customer.index') }}"
                class="sidebar-link {{ sideBarMenuActiver(route('admin.user.customer.index')) }}">
                <i class="fa-regular fa-house text-xl"></i>
                مشتریان
            </a>
            <a href="{{ route('admin.user.role.index') }}"
                class="sidebar-link {{ sideBarMenuActiver(route('admin.user.role.index')) }}">
                <i class="fa-regular fa-house text-xl"></i>
                سطوح دسترسی
            </a>

            <span class="text-gray-500 text-xs">بخش تیکت ها</span>

            <button class="sidebar-btn" onclick="toggleSidebarDropdownBtn(this)">

                <div class="flex justify-between w-full">
                    <span>
                        <i class="fa-light fa-ticket text-xl"></i>
                        تیکت ها
                    </span>

                    <span class="angle ml-2 transition-all duration-300">
                        <i class="fa fa-angle-left"></i>
                    </span>
                </div>

                <ul class="hidden dropdown w-full mt-4 flex-col gap-y-2">
                    <a href="{{ route('admin.ticket.new-tickets') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4 hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            تیکت های جدید
                        </span>
                    </a>
                    <a href="{{ route('admin.ticket.opened-tickets') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4 hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            تیکت های باز
                        </span>
                    </a>
                    <a href="{{ route('admin.ticket.closed-tickets') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            تیکت های بسته
                        </span>
                    </a>
                    <a href="{{ route('admin.ticket.index') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            تمام تیکت ها
                        </span>
                    </a>
                    <a href="{{ route('admin.ticket.admin.index') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            ادمین تیکت ها
                        </span>
                    </a>
                    <a href="{{ route('admin.ticket.category.index') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            دسته بندی تیکت ها
                        </span>
                    </a>
                    <a href="{{ route('admin.ticket.priority.index') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span
                            class="mr-4 text-slate-800 dark:text-slate-200 flex items-center gap-x-4  hover-transition hover:text-purple-800 dark:hover:text-purple-500">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            اولویت بندی تیکت ها
                        </span>
                    </a>
                </ul>

            </button>


            <span class="text-gray-500 text-xs">بخش اطلاع رسانی</span>


            <a href="{{ route('admin.notify.email.index') }}"
                class="sidebar-link {{ sideBarMenuActiver(route('admin.notify.email.index')) }}">
                <i class="fa-light fa-envelopes text-xl"></i>
                اطلاعیه ایمیلی
            </a>
            <a href="{{ route('admin.notify.sms.index') }}"
                class="sidebar-link {{ sideBarMenuActiver(route('admin.notify.sms.index')) }}">
                <i class="fa-light fa-message-sms text-xl"></i>
                اطلاعیه پیامکی
            </a>

            <span class="text-gray-500 text-xs">بخش تنظیمات</span>


            <a href="{{ route('admin.setting.index') }}"
                class="sidebar-link {{ sideBarMenuActiver(route('admin.setting.index')) }}">
                <i class="fa-light fa-gear text-xl"></i>
                تنظیمات
            </a>
        </div>
    </div>

</aside>
