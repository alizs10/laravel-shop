<aside id="sidebar" class="sidebar toggleSidebar md:fixed md:top-0 md:right-0 md:w-1/4">

    <div class="flex flex-col gap-y-2">
        <span class="text-purple-800 dark:text-purple-400 font-bold text-base xs:text-lg">پنل ادمین
            پیشرفته</span>

        <div class="mt-4 flex flex-col gap-y-4">
            <a href="{{ route('admin.home') }}" class="sidebar-link {{ sideBarMenuActiver(route('admin.home')) }}">
                <i class="fa-light fa-house text-xl"></i>
                خانه
            </a>

            <span class="text-gray-500 text-xs">بخش فروش</span>

            <button
                class="sidebar-btn {{ sidebarDropdownActiver('admin.market', ['category.index', 'property.index', 'category-spec.index', 'product.index', 'brand.index', 'store.index', 'comment.index'])['btn'] }}"
                onclick="toggleSidebarDropdownBtn(this)">

                <div class="flex justify-between w-full">
                    <span>
                        <i class="fa-light fa-cart-circle-arrow-up text-xl"></i>
                        فروشگاه
                    </span>

                    <span
                        class="angle ml-2 transition-all duration-300  {{ sidebarDropdownActiver('admin.market', ['category.index', 'property.index', 'product.index', 'brand.index', 'store.index', 'comment.index'])['rotate'] }}">
                        <i class="fa fa-angle-left"></i>
                    </span>
                </div>

                <ul
                    class="{{ sidebarDropdownActiver('admin.market', ['category.index', 'property.index', 'product.index', 'brand.index', 'store.index', 'comment.index'])['hidden'] }} dropdown w-full mt-4 flex-col gap-y-2">
                    <a href="{{ route('admin.market.category.index') }}" class="flex items-center gap-x-4 text-sm">
                        <span class="{{ sidebarDropdownMenuActiver(route('admin.market.category.index')) }}">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            دسته بندی
                        </span>
                    </a>
                    <a href="{{ route('admin.market.property.index') }}" class="flex items-center gap-x-4 text-sm">
                        <span class="{{ sidebarDropdownMenuActiver(route('admin.market.property.index')) }}">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            فرم کالا
                        </span>
                    </a>
                    <a href="{{ route('admin.market.category-spec.index') }}"
                        class="flex items-center gap-x-4 text-sm">
                        <span class="{{ sidebarDropdownMenuActiver(route('admin.market.category-spec.index')) }}">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            مشخصات کالا
                        </span>
                    </a>
                    <a href="{{ route('admin.market.product.index') }}" class="flex items-center gap-x-4 text-sm">
                        <span class="{{ sidebarDropdownMenuActiver(route('admin.market.product.index')) }}">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            محصولات
                        </span>
                    </a>
                    <a href="{{ route('admin.market.brand.index') }}" class="flex items-center gap-x-4 text-sm">
                        <span class="{{ sidebarDropdownMenuActiver(route('admin.market.brand.index')) }}">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            برند
                        </span>
                    </a>
                    <a href="{{ route('admin.market.store.index') }}" class="flex items-center gap-x-4 text-sm">
                        <span class="{{ sidebarDropdownMenuActiver(route('admin.market.store.index')) }}">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            انبار
                        </span>
                    </a>
                    <a href="{{ route('admin.market.comment.index') }}" class="flex items-center gap-x-4 text-sm">
                        <span class="{{ sidebarDropdownMenuActiver(route('admin.market.comment.index')) }}">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            نظرات
                        </span>
                    </a>
                </ul>

            </button>
            <button
                class="sidebar-btn {{ sidebarDropdownActiver('admin.market', ['order.newOrders', 'order.processing', 'order.delivering', 'order.unpaid', 'order.expired', 'order.returned', 'order.returned', 'order.index'])['btn'] }}"
                onclick="toggleSidebarDropdownBtn(this)">

                <div class="flex justify-between w-full">
                    <span>
                        <i class="fa-light fa-clipboard-list text-xl"></i>
                        سفارشات
                    </span>

                    <span
                        class="angle ml-2 transition-all duration-300 {{ sidebarDropdownActiver('admin.market', ['order.newOrders', 'order.processing', 'order.delivering', 'order.unpaid', 'order.expired', 'order.returned', 'order.returned', 'order.index'])['rotate'] }}">
                        <i class="fa fa-angle-left"></i>
                    </span>
                </div>

                <ul
                    class="{{ sidebarDropdownActiver('admin.market', ['order.newOrders', 'order.processing', 'order.delivering', 'order.unpaid', 'order.expired', 'order.returned', 'order.returned', 'order.index'])['hidden'] }} dropdown w-full mt-4 flex-col gap-y-2">
                    <a href="{{ route('admin.market.order.newOrders') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span class="{{ sidebarDropdownMenuActiver(route('admin.market.order.newOrders')) }}">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            جدید
                        </span>
                    </a>
                    <a href="{{ route('admin.market.order.processing') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span class="{{ sidebarDropdownMenuActiver(route('admin.market.order.processing')) }}">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            در حال پردازش
                        </span>
                    </a>
                    <a href="{{ route('admin.market.order.delivering') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span class="{{ sidebarDropdownMenuActiver(route('admin.market.order.delivering')) }}">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            در حال ارسال
                        </span>
                    </a>
                    <a href="{{ route('admin.market.order.unpaid') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span class="{{ sidebarDropdownMenuActiver(route('admin.market.order.unpaid')) }}">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            پرداخت نشده
                        </span>
                    </a>
                    <a href="{{ route('admin.market.order.expired') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span class="{{ sidebarDropdownMenuActiver(route('admin.market.order.expired')) }}">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            باطل شده
                        </span>
                    </a>
                    <a href="{{ route('admin.market.order.returned') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span class="{{ sidebarDropdownMenuActiver(route('admin.market.order.returned')) }}">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            مرجوعی
                        </span>
                    </a>
                    <a href="{{ route('admin.market.order.index') }}"
                        class="flex items-center gap-x-4 text-sm text-slate-900">
                        <span class="{{ sidebarDropdownMenuActiver(route('admin.market.order.index')) }}">
                            <i class="fa-solid fa-angles-left text-xxs"></i>
                            تمام سفارشات
                        </span>
                    </a>
                </ul>

            </button>
            @can('index', \App\Models\Market\Payment::class)
                <button
                    class="sidebar-btn {{ sidebarDropdownActiver('admin.market', ['payment.all', 'payment.online', 'payment.offline', 'payment.cash'])['btn'] }}"
                    onclick="toggleSidebarDropdownBtn(this)">

                    <div class="flex justify-between w-full">
                        <span>
                            <i class="fa-light fa-money-check-dollar text-xl"></i>
                            پرداخت ها
                        </span>

                        <span
                            class="angle ml-2 transition-all duration-300 {{ sidebarDropdownActiver('admin.market', ['payment.all', 'payment.online', 'payment.offline', 'payment.cash'])['rotate'] }}">
                            <i class="fa fa-angle-left"></i>
                        </span>
                    </div>

                    <ul
                        class="{{ sidebarDropdownActiver('admin.market', ['payment.all', 'payment.online', 'payment.offline', 'payment.cash'])['hidden'] }} dropdown w-full mt-4 flex-col gap-y-2">
                        <a href="{{ route('admin.market.payment.all') }}"
                            class="flex items-center gap-x-4 text-sm text-slate-900">
                            <span class="{{ sidebarDropdownMenuActiver(route('admin.market.payment.all')) }}">
                                <i class="fa-solid fa-angles-left text-xxs"></i>
                                کل پرداخت ها
                            </span>
                        </a>
                        <a href="{{ route('admin.market.payment.online') }}"
                            class="flex items-center gap-x-4 text-sm text-slate-900">
                            <span class="{{ sidebarDropdownMenuActiver(route('admin.market.payment.online')) }}">
                                <i class="fa-solid fa-angles-left text-xxs"></i>
                                پرداخت های آنلاین
                            </span>
                        </a>
                        <a href="{{ route('admin.market.payment.offline') }}"
                            class="flex items-center gap-x-4 text-sm text-slate-900">
                            <span class="{{ sidebarDropdownMenuActiver(route('admin.market.payment.offline')) }}">
                                <i class="fa-solid fa-angles-left text-xxs"></i>
                                پرداخت های آفلاین
                            </span>
                        </a>
                        <a href="{{ route('admin.market.payment.cash') }}"
                            class="flex items-center gap-x-4 text-sm text-slate-900">
                            <span class="{{ sidebarDropdownMenuActiver(route('admin.market.payment.cash')) }}">
                                <i class="fa-solid fa-angles-left text-xxs"></i>
                                پرداخت های در محل
                            </span>
                        </a>
                    </ul>

                </button>
            @endcan
            <button
                class="sidebar-btn {{ sidebarDropdownActiver('admin.market.discount', ['coupon', 'public', 'amazing'])['btn'] }}"
                onclick="toggleSidebarDropdownBtn(this)">

                <div class="flex justify-between w-full">
                    <span>
                        <i class="fa-light fa-badge-percent text-xl"></i>
                        تخفیف ها
                    </span>

                    <span
                        class="angle ml-2 transition-all duration-300  {{ sidebarDropdownActiver('admin.market.discount', ['coupon', 'public', 'amazing'])['rotate'] }}">
                        <i class="fa fa-angle-left"></i>
                    </span>
                </div>

                <ul
                    class=" {{ sidebarDropdownActiver('admin.market.discount', ['coupon', 'public', 'amazing'])['hidden'] }} dropdown w-full mt-4 flex-col gap-y-2">

                    @can('index', \App\Models\Market\Coupon::class)
                        <a href="{{ route('admin.market.discount.coupon') }}"
                            class="flex items-center gap-x-4 text-sm text-slate-900">
                            <span class="{{ sidebarDropdownMenuActiver(route('admin.market.discount.coupon')) }}">
                                <i class="fa-solid fa-angles-left text-xxs"></i>
                                کوپن های تخفیف
                            </span>
                        </a>
                    @endcan
                    @can('index', \App\Models\Market\PublicDiscount::class)
                        <a href="{{ route('admin.market.discount.public') }}"
                            class="flex items-center gap-x-4 text-sm text-slate-900">
                            <span class="{{ sidebarDropdownMenuActiver(route('admin.market.discount.public')) }}">
                                <i class="fa-solid fa-angles-left text-xxs"></i>
                                تخفیف های عمومی
                            </span>
                        </a>
                    @endcan
                    @can('index', \App\Models\Market\AmazingSale::class)
                        <a href="{{ route('admin.market.discount.amazing') }}"
                            class="flex items-center gap-x-4 text-sm text-slate-900">
                            <span class="{{ sidebarDropdownMenuActiver(route('admin.market.discount.amazing')) }}">
                                <i class="fa-solid fa-angles-left text-xxs"></i>
                                تخفیف های شگفت انگیز
                            </span>
                        </a>
                    @endcan
                </ul>

            </button>

            @can('index', \App\Models\Market\Delivery::class)
                <a href="{{ route('admin.market.delivery.index') }}"
                    class="sidebar-link {{ sideBarMenuActiver(route('admin.market.delivery.index')) }}">
                    <i class="fa-light fa-truck-ramp-box text-xl"></i>
                    روش های ارسال
                </a>
            @endcan
            <span class="text-gray-500 text-xs">بخش محتوی</span>
            @can('index', \App\Models\Content\PostCategory::class)
                <a href="{{ route('admin.content.category.index') }}"
                    class="sidebar-link {{ sideBarMenuActiver(route('admin.content.category.index')) }}">
                    <i class="fa-light fa-folder-tree text-xl"></i>
                    دسته بندی
                </a>
            @endcan

            @can('index', \App\Models\Content\Post::class)
                <a href="{{ route('admin.content.post.index') }}"
                    class="sidebar-link {{ sideBarMenuActiver(route('admin.content.post.index')) }}">
                    <i class="fa-light fa-square-pen text-xl"></i>
                    پست ها
                </a>
            @endcan
            @can('index', \App\Models\Comment::class)
                <a href="{{ route('admin.content.comment.index') }}"
                    class="sidebar-link {{ sideBarMenuActiver(route('admin.content.comment.index')) }}">
                    <i class="fa-light fa-comments text-xl"></i>
                    نظرات
                </a>
            @endcan
            @can('index', \App\Models\Content\Menu::class)
                <a href="{{ route('admin.content.menu.index') }}"
                    class="sidebar-link {{ sideBarMenuActiver(route('admin.content.menu.index')) }}">
                    <i class="fa-light fa-bars text-xl"></i>
                    منو
                </a>
            @endcan
            @can('index', \App\Models\Content\AdvertisementBaner::class)
                <a href="{{ route('admin.content.advertisement-baner.index') }}"
                    class="sidebar-link {{ sideBarMenuActiver(route('admin.content.advertisement-baner.index')) }}">
                    <i class="fa-light fa-rectangle-ad text-xl"></i>
                    بنرهای تبلیغاتی
                </a>
            @endcan
            @can('index', \App\Models\Content\Faq::class)
                <a href="{{ route('admin.content.faq.index') }}"
                    class="sidebar-link {{ sideBarMenuActiver(route('admin.content.faq.index')) }}">
                    <i class="fa-light fa-comments-question-check text-xl"></i>
                    سوالات متداول
                </a>
            @endcan
            @can('index', \App\Models\Content\Page::class)
                <a href="{{ route('admin.content.page.index') }}"
                    class="sidebar-link {{ sideBarMenuActiver(route('admin.content.page.index')) }}">
                    <i class="fa-light fa-file-circle-plus text-xl"></i>
                    پیج ساز
                </a>
            @endcan
            @can('index', \App\Models\User::class)
                <span class="text-gray-500 text-xs">بخش کاربران</span>

                <a href="{{ route('admin.user.admin-user.index') }}"
                    class="sidebar-link {{ sideBarMenuActiver(route('admin.user.admin-user.index')) }}">
                    <i class="fa-light fa-users-crown text-xl"></i>
                    ادمین ها
                </a>
                <a href="{{ route('admin.user.customer.index') }}"
                    class="sidebar-link {{ sideBarMenuActiver(route('admin.user.customer.index')) }}">
                    <i class="fa-light fa-users text-xl"></i>
                    مشتریان
                </a>
                <a href="{{ route('admin.user.role.index') }}"
                    class="sidebar-link {{ sideBarMenuActiver(route('admin.user.role.index')) }}">
                    <i class="fa-light fa-lock-keyhole text-xl"></i>
                    سطوح دسترسی
                </a>
            @endcan
            <span class="text-gray-500 text-xs">بخش تیکت ها</span>

            <button
                class="sidebar-btn {{ sidebarDropdownActiver('admin.ticket', ['new-tickets', 'opened-tickets', 'closed-tickets', 'index', 'admin.index', 'category.index', 'priority.index'])['btn'] }}"
                onclick="toggleSidebarDropdownBtn(this)">

                <div class="flex justify-between w-full">
                    <span>
                        <i class="fa-light fa-ticket text-xl"></i>
                        تیکت ها
                    </span>

                    <span
                        class="angle ml-2 transition-all duration-300 {{ sidebarDropdownActiver('admin.ticket', ['new-tickets', 'opened-tickets', 'closed-tickets', 'index', 'admin.index', 'category.index', 'priority.index'])['rotate'] }}">
                        <i class="fa fa-angle-left"></i>
                    </span>
                </div>

                <ul
                    class="{{ sidebarDropdownActiver('admin.ticket', ['new-tickets', 'opened-tickets', 'closed-tickets', 'index', 'admin.index', 'category.index', 'priority.index'])['hidden'] }} dropdown w-full mt-4 flex-col gap-y-2">
                    @can('index', \App\Models\Ticket\Ticket::class)
                        <a href="{{ route('admin.ticket.new-tickets') }}"
                            class="flex items-center gap-x-4 text-sm text-slate-900">
                            <span
                                class="sidebar-link {{ sidebarDropdownMenuActiver(route('admin.ticket.new-tickets')) }}">
                                <i class="fa-solid fa-angles-left text-xxs"></i>
                                تیکت های جدید
                            </span>
                        </a>
                        <a href="{{ route('admin.ticket.opened-tickets') }}"
                            class="flex items-center gap-x-4 text-sm text-slate-900">
                            <span
                                class="sidebar-link {{ sidebarDropdownMenuActiver(route('admin.ticket.opened-tickets')) }}">
                                <i class="fa-solid fa-angles-left text-xxs"></i>
                                تیکت های باز
                            </span>
                        </a>
                        <a href="{{ route('admin.ticket.closed-tickets') }}"
                            class="flex items-center gap-x-4 text-sm text-slate-900">
                            <span
                                class="sidebar-link {{ sidebarDropdownMenuActiver(route('admin.ticket.closed-tickets')) }}">
                                <i class="fa-solid fa-angles-left text-xxs"></i>
                                تیکت های بسته
                            </span>
                        </a>
                        <a href="{{ route('admin.ticket.index') }}"
                            class="flex items-center gap-x-4 text-sm text-slate-900">
                            <span class="sidebar-link {{ sidebarDropdownMenuActiver(route('admin.ticket.index')) }}">
                                <i class="fa-solid fa-angles-left text-xxs"></i>
                                تمام تیکت ها
                            </span>
                        </a>
                    @endcan
                    @can('index', \App\Models\Ticket\TicketAdmin::class)
                        <a href="{{ route('admin.ticket.admin.index') }}"
                            class="flex items-center gap-x-4 text-sm text-slate-900">
                            <span
                                class="sidebar-link {{ sidebarDropdownMenuActiver(route('admin.ticket.admin.index')) }}">
                                <i class="fa-solid fa-angles-left text-xxs"></i>
                                ادمین تیکت ها
                            </span>
                        </a>
                    @endcan
                    @can('index', \App\Models\Ticket\TicketCategory::class)
                        <a href="{{ route('admin.ticket.category.index') }}"
                            class="flex items-center gap-x-4 text-sm text-slate-900">
                            <span
                                class="sidebar-link {{ sidebarDropdownMenuActiver(route('admin.ticket.category.index')) }}">
                                <i class="fa-solid fa-angles-left text-xxs"></i>
                                دسته بندی تیکت ها
                            </span>
                        </a>
                    @endcan
                    @can('index', \App\Models\Ticket\TicketPriority::class)
                        <a href="{{ route('admin.ticket.priority.index') }}"
                            class="flex items-center gap-x-4 text-sm text-slate-900">
                            <span
                                class="sidebar-link {{ sidebarDropdownMenuActiver(route('admin.ticket.priority.index')) }}">
                                <i class="fa-solid fa-angles-left text-xxs"></i>
                                اولویت بندی تیکت ها
                            </span>
                        </a>
                    @endcan
                </ul>

            </button>



            <span class="text-gray-500 text-xs">بخش اطلاع رسانی</span>

            @can('index', \App\Models\Notify\Email::class)
                <a href="{{ route('admin.notify.email.index') }}"
                    class="sidebar-link {{ sideBarMenuActiver(route('admin.notify.email.index')) }}">
                    <i class="fa-light fa-envelopes text-xl"></i>
                    اطلاعیه ایمیلی
                </a>
            @endcan
            @can('index', \App\Models\Notify\SMS::class)
                <a href="{{ route('admin.notify.sms.index') }}"
                    class="sidebar-link {{ sideBarMenuActiver(route('admin.notify.sms.index')) }}">
                    <i class="fa-light fa-message-sms text-xl"></i>
                    اطلاعیه پیامکی
                </a>
            @endcan


            @can('index', \App\Models\Setting\Setting::class)
                <span class="text-gray-500 text-xs">بخش تنظیمات</span>
                <a href="{{ route('admin.setting.index') }}"
                    class="sidebar-link {{ sideBarMenuActiver(route('admin.setting.index')) }}">
                    <i class="fa-light fa-gear text-xl"></i>
                    تنظیمات
                </a>
            @endcan

        </div>
    </div>

</aside>
