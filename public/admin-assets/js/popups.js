var isAlertsPopupVisible = false;
var isCommentsPopupVisible = false;
var isUserPopupVisible = false;

const alertsPopupToggle = () => {
    if (!isAlertsPopupVisible) {
        isAlertsPopupVisible = true;
        closePopups('alerts')
        $('#alerts-popup-btn div').removeClass('hidden');
        document.addEventListener('click', outsideClick);
        if ($('#new-alerts-badge').length > 0) {
            readNotifications();
        }
    } else {
        isAlertsPopupVisible = false
        $('#alerts-popup-btn div').addClass('hidden');
    }
}

const commentsPopupToggle = () => {
    if (!isCommentsPopupVisible) {
        isCommentsPopupVisible = true;
        closePopups('comments')
        $('#comments-popup-btn div').removeClass('hidden');
        document.addEventListener('click', outsideClick);
    } else {
        isCommentsPopupVisible = false
        $('#comments-popup-btn div').addClass('hidden');
    }
}
const userPopupToggle = () => {
    if (!isUserPopupVisible) {
        isUserPopupVisible = true;
        closePopups('user')
        $('#user-popup-btn div').removeClass('hidden');
        document.addEventListener('click', outsideClick);
    } else {
        isUserPopupVisible = false
        $('#user-popup-btn div').addClass('hidden');
    }
}

function closePopups(exception) {

    if (isAlertsPopupVisible && exception !== 'alerts') {
        alertsPopupToggle()
    }
    if (isUserPopupVisible && exception !== 'user') {
        userPopupToggle()
    }
    if (isCommentsPopupVisible && exception !== 'comments') {
        commentsPopupToggle()
    }


}

function readNotifications() {
    $.ajax({
        method: 'get',
        url: '/admin/notifications/read-all',
        success: function (response) {
            return response.status
        }
    })
}

function outsideClick(event) {

    console.log('click');

    let tg = event.target;

    if ($('#alerts-popup-btn')[0] !== tg && $('#alerts-popup-btn').find(tg).length == 0) {
        isAlertsPopupVisible = false
        $('#alerts-popup-btn div').addClass('hidden');
    }
    if ($('#comments-popup-btn')[0] !== tg && $('#comments-popup-btn').find(tg).length == 0) {
   
        isCommentsPopupVisible = false
        $('#comments-popup-btn div').addClass('hidden');
    }
    if ($('#user-popup-btn')[0] !== tg && $('#user-popup-btn').find(tg).length == 0) {
        isUserPopupVisible = false
        $('#user-popup-btn div').addClass('hidden');
    }

    if (!isAlertsPopupVisible && !isCommentsPopupVisible && !isUserPopupVisible) {
        document.removeEventListener('click', outsideClick)
    }


}