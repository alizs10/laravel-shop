<html lang="en">

<head>
    @include('admin.layouts.head-tags')
    @yield('head-tag')

</head>

<body>
    <script src="{{ asset('admin-assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/persianumber.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/js.cookie.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('body').persiaNumber();
        });
    </script>
    <script type="text/javascript">
        if (Cookies.get('themeMode')) {
            document.documentElement.setAttribute("data-theme", Cookies.get('themeMode'));
        }
    </script>
    <section id="main">

        @include('admin.layouts.sidebar')

        <button class="button edge-menu-btn">
            <i class="fas fa-arrow-right" id="minimizerIcon"></i>
        </button>

        <section class="content">

            <div class="container">


                <div class="flex-column flex-row-gap-2">

                    @include('admin.layouts.navbar')

                    @yield('content')
                </div>



            </div>

        </section>


    </section>

    <div class="closer hidden"></div>
</body>
@include('admin.layouts.scripts')
@yield('script')
@include('admin.alerts.success')
@include('admin.alerts.error')
@include('admin.alerts.warning')
@include('admin.alerts.info')

</html>
