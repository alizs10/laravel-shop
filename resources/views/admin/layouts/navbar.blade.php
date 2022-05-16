<div class="box-container row-head mt-space">


    <div class="row-head">

        <button class="menu"
            onclick="this.classList.toggle('opened');this.setAttribute('aria-expanded', this.classList.contains('opened'))"
            aria-label="Main Menu">
            <svg width="50" height="50" viewBox="0 0 100 100">
                <path class="line line1"
                    d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                <path class="line line2" d="M 20,50 H 80" />
                <path class="line line3"
                    d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
            </svg>
        </button>

        <div class="userInfo">

            <i class="fas fa-user" id="user-avatar"></i>
            <div class="userInformations cursor-pointer rounded">
                <h6>علی سلیمانی</h6>
                <i class="fas fa-chevron-down"></i>
                <p id="status">آنلاین</p>

            </div>
            <div class="user-window">
                <ul>

                    <li>
                        <i class="fas fa-user"></i>
                        <span>پروفایل</span>
                    </li>
                    <li>
                        <i class="fas fa-cog"></i>
                        <span>تنظیمات</span>
                    </li>
                    <li>
                        <i class="fas fa-sign-out-alt"></i>
                        <span>خروج</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="flex-row flex-column-gap-1 flex-align-center ml-space position-relative">

        <div class="settings">
            <div class="switch-theme-btn">
                <div class="switch-btn flex-center" id="switch-btn"><i class="far fa-moon"></i>
                </div>
            </div>
        </div>

        <div class="a-notifications cursor-pointer rounded">
            <div class="a-notif-alert">2</div>
            <i class="far fa-bell"></i>
        </div>
        <div class="a-notification-window">
            <ul>

                <li>
                    <i class="fas fa-user"></i>
                    <span>
                        <span>علی سلیمانی</span>
                        <span class="text-primary">یک پست جدید منتشر کرد</span>
                        <span class="text-info">30 دقیقه قبل</span>
                    </span>
                    <i class="fas fa-circle text-success"></i>
                </li>
                <li>
                    <i class="fas fa-user"></i>
                    <span>
                        <span>علی سلیمانی</span>
                        <span class="text-primary">یک پست جدید منتشر کرد</span>
                        <span class="text-info">30 دقیقه قبل</span>
                    </span>
                    <i class="fas fa-circle text-success"></i>
                </li>
                <li>
                    <i class="fas fa-user"></i>
                    <span>
                        <span>علی سلیمانی</span>
                        <span class="text-primary">یک پست جدید منتشر کرد</span>
                        <span class="text-info">30 دقیقه قبل</span>
                    </span>
                    <i class="fas fa-circle text-success"></i>
                </li>
                <li>
                    <i class="fas fa-user"></i>
                    <span>
                        <span>علی سلیمانی</span>
                        <span class="text-primary">یک پست جدید منتشر کرد</span>
                        <span class="text-info">30 دقیقه قبل</span>
                    </span>
                    <i class="fas fa-circle text-success"></i>
                </li>
                <li>
                    <i class="fas fa-user"></i>
                    <span>
                        <span>علی سلیمانی</span>
                        <span class="text-primary">یک پست جدید منتشر کرد</span>
                        <span class="text-info">30 دقیقه قبل</span>
                    </span>
                    <i class="fas fa-circle text-success"></i>
                </li>
                <li>
                    <i class="fas fa-user"></i>
                    <span>
                        <span>علی سلیمانی</span>
                        <span class="text-primary">یک پست جدید منتشر کرد</span>
                        <span class="text-info">30 دقیقه قبل</span>
                    </span>
                    <i class="fas fa-circle text-success"></i>
                </li>
                <li>
                    <i class="fas fa-user"></i>
                    <span>
                        <span>علی سلیمانی</span>
                        <span class="text-primary">یک پست جدید منتشر کرد</span>
                        <span class="text-info">30 دقیقه قبل</span>
                    </span>
                    <i class="fas fa-circle text-success"></i>
                </li>
            </ul>
        </div>

        <div class="c-notifications cursor-pointer rounded">
            <div class="notif-alert">{{ count($unseenComments) }}</div>
            <i class="far fa-comment-alt"></i>
        </div>
        <div class="c-notification-window">
            <ul>

                @foreach ($unseenComments as $unseenComment)
                <li>
                    <i class="fas fa-user"></i>
                    <span>
                        <span>{{ $unseenComment->user->name ?? 'ناشناس' }}</span>
                        <span class="text-primary">{{ Str::limit($unseenComment->body, 15, '...') }}</span>
                    </span>
                    <i class="fas fa-circle text-success"></i>
                </li>
                @endforeach
                

            </ul>
        </div>

        <a href="" class="button goLive">سایت</a>
    </div>
</div>