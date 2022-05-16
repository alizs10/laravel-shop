$(document).ready(function () {

    const sideMenu = $('.sideMenu');
    const content = $('.content');
    const minimizer = $('.edge-menu-btn');
    const minimizerIcon = $('#minimizerIcon');

    let isSidebarMenuOpen = true;

    minimizer.click(function () { 

        if (isSidebarMenuOpen) {
            isSidebarMenuOpen = false;
            setTimeout(function () {
                sideMenu.css('width', '0%');
                content.css('width', '100%');
                minimizerIcon.css('transform', 'rotate(' + 180 + 'deg)');
                minimizer.css('left', 'calc(' + 100 + '% - 1rem)');

            }, 300)
        } else {
            isSidebarMenuOpen = true;
            setTimeout(function () {
                sideMenu.css('width', '20%');
                content.css('width', '80%');
                minimizerIcon.css('transform', 'rotate(' + 0 + 'deg)');
                minimizer.css('left', '80%');

            }, 300)
        }
        
    });
});