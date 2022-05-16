$(document).ready(function () {  
    $('[hasSubMenu]').click(function (e) { 
        
        var element = $(this);
        var subMenuOld = $('.sub-menu-active');

        $('.menuSelected').removeClass('menuSelected')

        if (subMenuOld) {
            subMenuOld.removeClass('sub-menu-active')
            subMenuOld.addClass('sub-menu')
        }
        
        element.addClass("menuSelected")

        

        var elementSubMenuStatus = element.attr('hasSubMenu');
        if (elementSubMenuStatus == 'true') {
            var subMenu = element.find('.sub-menu')
            
            if (subMenu) {
                subMenu.removeClass('sub-menu')
                subMenu.addClass('sub-menu-active')
            }
            
        }
        
        
    });

});