<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('app-assets/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/packages/fontawesome/css/all.min.css') }}" />


    <script type="text/javascript">
        if (localStorage.themeMode === 'dark' || (!('themeMode' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <script src="{{ asset('app-assets/js/jquery-3.6.0.min.js') }}"></script>
</head>
