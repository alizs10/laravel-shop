$('#verification_code_form input')[0].focus();

$('#verification_code_form input').on('input', function () {

    if (isNaN($(this).val())) {
        $(this).val('')
        return;
    }
    let id = $(this).attr('id')
    id = id.slice(4, id.length)

    if ($(this).val().length === 1 && id < 6) {
        $('#verification_code_form input')[id].focus()
    }

})

$('#verification_code_form input').on('keydown', function (event) {

    let id = $(this).attr('id')
    id = id.slice(4, id.length)
    if ($(this).val().length === 0 && id > 1 && event.keyCode == 8) {
        $('#verification_code_form input')[id - 2].focus()
    }

})


var timer = 10;

function countDown() {
    const timerInterval = setInterval(function () {
        timer -= 1;
        $('#timer-text').html(`ارسال مجدد کد تایید در ${timer} ثانیه دیگر`)

        if (timer <= 0) {
            clearInterval(timerInterval)

            $('#timer-text').html('<button class="text-xs text-red-500" onclick="sendVCode()">ارسال مجدد کد تایید</button>')
        }
    }, 1000)

}

countDown()


function sendVCode() {
    var email = $('#email').val()
    $.ajax({
        url: `/send-verification-code?email=${email}`,
        method: 'get',
        success: function (response) {
            if (response.status) {
                $('#timer-text').html('کد تایید مجددا به ایمیل شما ارسال شد')
            }else {
                $('#timer-text').html('خطایی در ارسال کد رخ داده است')
            }
        }

    });
}