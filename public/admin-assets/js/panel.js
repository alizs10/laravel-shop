const sideMenuBtns = document.querySelectorAll('.menu-btns div');

for (let i = 0; i < sideMenuBtns.length; i++) {
    
    sideMenuBtns[i].addEventListener('click', () => {

        var oldSelected = document.querySelector('.menuSelected');
        oldSelected.classList.remove('menuSelected');
        if (oldSelected.getAttribute('hasSubMenu')) {
            disableSubMenu(oldSelected);
        }
        sideMenuBtns[i].classList.add('menuSelected');
        if (sideMenuBtns[i].getAttribute('hasSubMenu')) {
            enableSubMenu(sideMenuBtns[i]);
        }

    });
    
    
}



disableSubMenu = (element) => {

    var childsNumber = element.childNodes.length;
    var lastChild = element.childNodes[childsNumber - 2];
    if (lastChild.classList[0] == 'sub-menu-active') {
        element.childNodes[3].classList.remove('fa-angle-down');
        element.childNodes[3].classList.add('fa-angle-left');
        lastChild.classList.remove('sub-menu-active');
        lastChild.classList.add('sub-menu');
    }
}

enableSubMenu = (element) => {

    var childsNumber = element.childNodes.length;
    var lastChild = element.childNodes[childsNumber - 2];
    if (lastChild.classList[0] == 'sub-menu') {
        element.childNodes[3].classList.remove('fa-angle-left');
        element.childNodes[3].classList.add('fa-angle-down');
        lastChild.classList.remove('sub-menu');
        lastChild.classList.add('sub-menu-active');
    }
}