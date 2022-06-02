<html lang="fa">

<head>
    @include('app.layouts.head')
    @yield('head-tag')
</head>

<body class="rtl relative bg-white dark:bg-gray-900 dark:text-white">

    @include('app.layouts.header')

    @include('app.layouts.sidebar')

    <main class="md:mx-2 mt-32 lg:mt-40">

        @yield('content')

    </main>

    @include('app.layouts.footer')

    <!-- background blur starts -->
    <div id="blur-back" onclick="toggleSidebar()"
        class="hidden lg:hidden fixed top-0 bottom-0 left-0 right-0 bg-gray-500/70 z-20 transition-all duration-300">
    </div>
    <!-- background blur ends -->
</body>
@include('app.layouts.scripts')

</html>
