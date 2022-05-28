var isCartPopupVisible = false;
var isUserPopupVisible = false;

const cartPopupToggle = () => {
    if (!isCartPopupVisible) {
        isCartPopupVisible = true;
        if (isUserPopupVisible) {
            userPopupToggle()
        }
        $('#cart-popup-btn').toggleClass('bg-gray-100 dark:bg-gray-800');
        $('#cart-popup-btn .hidden').toggleClass('hidden').toggleClass('flex')
        document.addEventListener('click', outsideClick)
    } else {
        isCartPopupVisible = false
        $('#cart-popup-btn').toggleClass('bg-gray-100 dark:bg-gray-800');
        $('#cart-popup-btn div').toggleClass('hidden').toggleClass('flex')
    }
}

const userPopupToggle = () => {
    if (!isUserPopupVisible) {
        isUserPopupVisible = true;
        if (isCartPopupVisible) {
            cartPopupToggle()
        } 
        $('#user-popup-btn').toggleClass('bg-gray-100 dark:bg-gray-800');
        $('#user-popup-btn .hidden').toggleClass('hidden').toggleClass('flex')
        document.addEventListener('click', outsideClick)
    } else {
        isUserPopupVisible = false
        $('#user-popup-btn').toggleClass('bg-gray-100 dark:bg-gray-800');
        $('#user-popup-btn div').toggleClass('hidden').toggleClass('flex')
    }
}

function outsideClick(event) {

    let tg = event.target;

    if ($('#cart-popup-btn')[0] !== tg && $('#cart-popup-btn').find(tg).length == 0) {
        isCartPopupVisible = false
        $('#cart-popup-btn').removeClass('bg-gray-100 dark:bg-gray-800');
        $('#cart-popup-btn div').addClass('hidden').removeClass('flex')
    }
  
    if ($('#user-popup-btn')[0] !== tg && $('#user-popup-btn').find(tg).length == 0) {
        isUserPopupVisible = false
        $('#user-popup-btn').removeClass('bg-gray-100 dark:bg-gray-800');
        $('#user-popup-btn div').addClass('hidden').removeClass('flex')
    }

    if (!isCartPopupVisible && !isUserPopupVisible) {
        document.removeEventListener('click', outsideClick)
    }


}