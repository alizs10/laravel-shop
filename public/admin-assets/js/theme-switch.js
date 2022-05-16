$(document).ready(function () {


    const switchBtn = $('#switch-btn');
    const switchPlaceHolder = $('.switch-theme-btn');

    let themeMode;
    const time = new Date().getHours();

    if (Cookies.get('themeMode')) {
        themeSwitcher(Cookies.get('themeMode'))
    }

    function themeSwitcher(mode) {
        if (mode === 'dark') {
            document.documentElement.setAttribute("data-theme", "dark");
            switchBtn.css('margin-right', '25px')
            switchPlaceHolder.css('background-color', 'var(--theme-color)')
            themeMode = 'dark';
            Cookies.set('themeMode', themeMode)
        } else {
            document.documentElement.setAttribute("data-theme", "light");
            switchBtn.css('margin-right', '0')
            switchPlaceHolder.css('background-color', '#adb5bd')
            themeMode = 'light';
            Cookies.set('themeMode', themeMode)
        }
    }


    if ((time >= 18 || time <= 7) && !Cookies.get('themeMode')) {
        themeSwitcher('dark');
        themeMode = 'dark';
    }

    switchBtn.click(function () {
        let themeModeRequest = themeMode === 'dark' ? 'light' : 'dark';
        themeSwitcher(themeModeRequest);
    });





});