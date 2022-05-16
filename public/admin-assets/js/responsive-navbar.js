$(document).ready(function () {
    $('.menu').click(function () {

        let isSideMenuOpen = false;

        function closeSideMenu() {
            $('.sideMenu').css('right', '-100%');
        }

        if (!isSideMenuOpen) {
            isSideMenuOpen = true;
            $('.sideMenu').css('right', '0');
            $('.closer').toggleClass('hidden')

        }

        $('.closer').click(function () {
            if (isSideMenuOpen) {
                closeSideMenu();
                $('.menu').removeClass('opened')
                $('.menu').attr('aria-expanded', false)
            }
        });

    });
});

