var isAlertsPopupVisible = false;
var isCommentsPopupVisible = false;
var isUserPopupVisible = false;

const alertsPopupToggle = () => {
    if (!isAlertsPopupVisible) {
        isAlertsPopupVisible = true;
        if (isCommentsPopupVisible) {
            commentsPopupToggle()
        }
        if (isUserPopupVisible) {
            userPopupToggle()
        }
        $('#alerts-popup-btn div').removeClass('hidden');
        readNotifications();
    } else {
        isAlertsPopupVisible = false
        $('#alerts-popup-btn div').addClass('hidden');
    }
}
const commentsPopupToggle = () => {

    if (!isCommentsPopupVisible) {
        isCommentsPopupVisible = true;
        if (isAlertsPopupVisible) {
            alertsPopupToggle()
        }
        if (isUserPopupVisible) {
            userPopupToggle()
        }
        $('#comments-popup-btn div').removeClass('hidden');
    } else {
        isCommentsPopupVisible = false
        $('#comments-popup-btn div').addClass('hidden');
    }
}
const userPopupToggle = () => {
    if (!isUserPopupVisible) {
        isUserPopupVisible = true;
        if (isAlertsPopupVisible) {
            alertsPopupToggle()
        }
        if (isCommentsPopupVisible) {
            commentsPopupToggle()
        }
        $('#user-popup-btn div').removeClass('hidden');
    } else {
        isUserPopupVisible = false
        $('#user-popup-btn div').addClass('hidden');
    }
}

function readNotifications() {

    $.ajax({
        method: 'get',
        url: '/admin/notifications/read-all',
        success: function (response) {

            return response.data.sattus

        }

    })

}