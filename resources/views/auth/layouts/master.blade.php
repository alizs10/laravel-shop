<html lang="fa">

@include('auth.layouts.head-tags')
@yield('head-tags')

<body class="rtl bg-white dark:bg-gray-900">

    <main class="mt-16 lg:mx-56">

        @yield('content')
       
    </main>

    <footer class="w-full py-2">
        <p class="text-slate-700 dark:text-gray-100 text-xs lg:text-sm w-full text-center">copyright 2022</p>
    </footer>

</body>
@include('auth.layouts.scripts')
@yield('scripts')
</html>
