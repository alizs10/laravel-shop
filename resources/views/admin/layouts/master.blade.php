<html lang="fa">

<head>
    @include('admin.layouts.head-tags')
    @yield('head-tag')

</head>

<body class="bg-white dark:bg-slate-900 flex justify-end" style="direction: rtl; position: relative">
    
    @include('admin.layouts.sidebar')
    <div class="flex flex-col w-full md:w-3/4 gap-y-1">
        @include('admin.layouts.header')
        @yield('breadcrumb')

        <main class="relative bg-slate-100 dark:bg-slate-800 dark:text-white p-1 m-2 rounded-lg drop-shadow-md">

            @yield('content')

        </main>
    </div>


    <script type="text/javascript">
        if (localStorage.themeMode === 'dark' || (!('themeMode' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</body>
@include('admin.layouts.scripts')
@yield('script')
@include('admin.alerts.success')
@include('admin.alerts.error')
@include('admin.alerts.warning')
@include('admin.alerts.info')

</html>
