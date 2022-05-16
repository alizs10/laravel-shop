$(document).ready(function () {


    function checkAndCloseWindow() {
        var openedWindow = $('.window-open')
        var windowTrigger = $('.window-trigger-active')
        if (openedWindow) {
            openedWindow.removeClass('window-open')
        }
        if (windowTrigger) {
            windowTrigger.removeClass('window-trigger-active')
        }
    }


    $('.userInformations').click(function (e) {
        checkAndCloseWindow()
        $('.user-window').toggleClass('window-open');
        $('.closer').toggleClass('hidden');
        $(this).toggleClass('window-trigger-active');

    });

    $('.a-notifications').click(function () {

        checkAndCloseWindow()
        $('.a-notification-window').toggleClass('window-open');
        $('.closer').toggleClass('hidden');
        $(this).toggleClass('window-trigger-active');

    });

    $('.c-notifications').click(function () {
        checkAndCloseWindow()
        $('.c-notification-window').toggleClass('window-open');
        $('.closer').toggleClass('hidden');
        $(this).toggleClass('window-trigger-active');

    });

    $('.closer').click(function () {
        checkAndCloseWindow()
        $(this).toggleClass('hidden');
    });
});