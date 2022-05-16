let dropdownBtns = document.querySelectorAll('[dropdown-btn]');
let dropdownMenus = document.querySelectorAll('[dropdown-menu]');


for (let i = 0; i < dropdownBtns.length; i++) {

    dropdownBtns[i].addEventListener('click', (e) => {


        let activeDropdownMenu = document.querySelector('.active-dropdown-menu');
        let activeDropdownBtn = document.querySelector('.active-dropdown-btn');


        if (e.target == activeDropdownBtn) {

            dropdownMenus[i].classList.add('hidden');
            activeDropdownBtn.classList.remove('active-dropdown-btn');

        } else {
            if (activeDropdownMenu) {
                activeDropdownMenu.classList.remove('active-dropdown-menu');
                activeDropdownMenu.classList.add('hidden');
            }

            if (activeDropdownBtn) {
                activeDropdownBtn.classList.remove('active-dropdown-btn');
            }

            dropdownMenus[i].classList.remove('hidden');
            dropdownMenus[i].classList.add('active-dropdown-menu');
            dropdownBtns[i].classList.add('active-dropdown-btn');
        }



    })

}