<section class="sideMenu flex-column">

    <div class="logo">
        <h1 class="text-size-titr mr-space">پنل مدیریتی پیشرفته</h1>
    </div>


    <div class="menu-btns flex-column text-size-2">


        <a class="{{ sideBarMenuActiver(route('admin.home')) }}" href="{{ route('admin.home') }}" hasSubMenu=false>
            <i class="fas fa-home mx-space"></i>
            خانه
        </a>

        <p class="text-info text-size-1 mr-space py-1">بخش فروش</p>

        <div class="flex-column cursor-pointer" hasSubMenu=true>
            <div class="row-head">
                <span class="flex-wrap">
                    <i class="fas fa-layer-group mx-space"></i>
                    <h3>ویترین</h3>
                </span>
                <i class="fas fa-angle-left ml-space"></i>
            </div>


            <div class="sub-menu">
                <a href="{{ route('admin.market.category.index') }}">دسته بندی</a>
                <a href="{{ route('admin.market.property.index') }}">فرم کالا</a>
                <a href="{{ route('admin.market.product.index') }}">محصولات</a>
                <a href="{{ route('admin.market.brand.index') }}">برند</a>
                <a href="{{ route('admin.market.store.index') }}">انبار</a>
                <a href="{{ route('admin.market.comment.index') }}">نظرات</a>
            </div>

        </div>
        <div class="flex-column cursor-pointer" hasSubMenu=true>
            <div class="row-head">
                <span class="flex-wrap">
                    <i class="fas fa-layer-group mx-space"></i>
                    <h3>سفارشات</h3>


                </span>
                <i class="fas fa-angle-left ml-space"></i>

            </div>

            <div class="sub-menu">
                <a href="{{ route('admin.market.order.newOrders') }}">جدید</a>
                <a href="{{ route('admin.market.order.delivering') }}">در حال ارسال</a>
                <a href="{{ route('admin.market.order.unpaid') }}">پرداخت نشده</a>
                <a href="{{ route('admin.market.order.expired') }}">باطل شده</a>
                <a href="{{ route('admin.market.order.returned') }}">مرجوعی</a>
                <a href="{{ route('admin.market.order.all') }}">تمام سفارشات</a>
            </div>
        </div>

        <div class="flex-column cursor-pointer" hasSubMenu=true>
            <div class="row-head">
                <span class="flex-wrap">
                    <i class="fas fa-layer-group mx-space"></i>
                    <h3>پرداخت ها</h3>


                </span>
                <i class="fas fa-angle-left ml-space"></i>

            </div>

            <div class="sub-menu">
                <a href="{{ route('admin.market.payment.all') }}">کل پرداخت ها</a>
                <a href="{{ route('admin.market.payment.online') }}">پرداخت های آنلاین</a>
                <a href="{{ route('admin.market.payment.offline') }}">پرداخت های آفلاین</a>
                <a href="{{ route('admin.market.payment.cash') }}">پرداخت های در محل</a>
            </div>
        </div>

        <div class="flex-column cursor-pointer" hasSubMenu=true>
            <div class="row-head">
                <span class="flex-wrap">
                    <i class="fas fa-layer-group mx-space"></i>
                    <h3>تخفیف ها</h3>


                </span>
                <i class="fas fa-angle-left ml-space"></i>

            </div>

            <div class="sub-menu">
                <a href="{{ route('admin.market.discount.coupon') }}">کوپن های تخفیف</a>
                <a href="{{ route('admin.market.discount.publicDiscount') }}">تخفیف های عمومی</a>
                <a href="{{ route('admin.market.discount.amazingDiscount') }}">تخفیف های شگفت انگیز</a>
            </div>
        </div>



        <a href="{{ route('admin.market.delivery.index') }}" hasSubMenu=false>
            <i class="fas fa-layer-group mx-space"></i>
            روش های ارسال
        </a>


        <p class="text-info text-size-1 mr-space py-1">بخش محتوی</p>

        <a class="{{ sideBarMenuActiver(route('admin.content.category.index')) }}"
            href="{{ route('admin.content.category.index') }}" hasSubMenu=false>
            <i class="fas fa-question mx-space"></i>
            دسته بندی
        </a>

        <a class="{{ sideBarMenuActiver(route('admin.content.post.index')) }}"
            href="{{ route('admin.content.post.index') }}" hasSubMenu=false>
            <i class="fas fa-question mx-space"></i>
            پست ها
        </a>

        <a class="{{ sideBarMenuActiver(route('admin.content.comment.index')) }}"
            href="{{ route('admin.content.comment.index') }}" hasSubMenu=false>
            <i class="fas fa-question mx-space"></i>
            نظرات
        </a>

        <a class="{{ sideBarMenuActiver(route('admin.content.menu.index')) }}"
            href="{{ route('admin.content.menu.index') }}" hasSubMenu=false>
            <i class="fas fa-question mx-space"></i>
            منو
        </a>

        <a class="{{ sideBarMenuActiver(route('admin.content.faq.index')) }}"
            href="{{ route('admin.content.faq.index') }}" hasSubMenu=false>
            <i class="fas fa-question mx-space"></i>
            سوالات متداول
        </a>

        <a class="{{ sideBarMenuActiver(route('admin.content.page.index')) }}"
            href="{{ route('admin.content.page.index') }}" hasSubMenu=false>
            <i class="fas fa-file-powerpoint mx-space"></i>
            پیج ساز
        </a>



        <p class="text-info text-size-1 mr-space py-1">بخش کاربران</p>

        <a class="{{ sideBarMenuActiver(route('admin.user.admin-user.index')) }}"
            href="{{ route('admin.user.admin-user.index') }}" hasSubMenu=false>
            <i class="fas fa-user-graduate mx-space"></i>
            ادمین ها
        </a>

        <a class="{{ sideBarMenuActiver(route('admin.user.customer.index')) }}"
            href="{{ route('admin.user.customer.index') }}" hasSubMenu=false>
            <i class="fas fa-users mx-space"></i>
            مشتریان
        </a>

        <a class="{{ sideBarMenuActiver(route('admin.user.role.index')) }}"
            href="{{ route('admin.user.role.index') }}" hasSubMenu=false>
            <i class="fas fa-user-tag mx-space"></i>
            سطوح دسترسی
        </a>

        <p class="text-info text-size-1 mr-space py-1">تیکت ها</p>

        <a class="{{ sideBarMenuActiver(route('admin.ticket.new-tickets')) }}"
            href="{{ route('admin.ticket.new-tickets') }}" hasSubMenu=false>
            <i class="fas fa-user-graduate mx-space"></i>
            تیکت های جدید
        </a>

        <a class="{{ sideBarMenuActiver(route('admin.ticket.opened-tickets')) }}"
            href="{{ route('admin.ticket.opened-tickets') }}" hasSubMenu=false>
            <i class="fas fa-users mx-space"></i>
            تیکت های باز
        </a>

        <a class="{{ sideBarMenuActiver(route('admin.ticket.closed-tickets')) }}"
            href="{{ route('admin.ticket.closed-tickets') }}" hasSubMenu=false>
            <i class="fas fa-user-tag mx-space"></i>
            تیکت های بسته
        </a>

        <a class="{{ sideBarMenuActiver(route('admin.ticket.index')) }}" href="{{ route('admin.ticket.index') }}"
            hasSubMenu=false>
            <i class="fas fa-user-tag mx-space"></i>
            تمامی تیکت ها
        </a>



        <p class="text-info text-size-1 mr-space py-1">اطلاع رسانی</p>

        <a class="{{ sideBarMenuActiver(route('admin.notify.email.index')) }}"
            href="{{ route('admin.notify.email.index') }}" hasSubMenu=false>
            <i class="fas fa-at mx-space"></i>
            اطلاعیه ایمیلی
        </a>


        <a class="{{ sideBarMenuActiver(route('admin.notify.sms.index')) }}"
            href="{{ route('admin.notify.sms.index') }}" hasSubMenu=false>
            <i class="fas fa-sms mx-space"></i>
            اطلاعیه پیامکی
        </a>


        <p class="text-info text-size-1 mr-space py-1">تنظیمات</p>

        <a class="{{ sideBarMenuActiver(route('admin.setting.index')) }}"
            href="{{ route('admin.setting.index') }}" hasSubMenu=false>
            <i class="fas fa-cogs mx-space"></i>
            تنظیمات
        </a>


    </div>




</section>

<script>
    $('.menuSelected').focus();
</script>
