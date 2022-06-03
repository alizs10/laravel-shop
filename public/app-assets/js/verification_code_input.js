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
            var email = $('#email').val()
            $('#timer-text').html('<a class="text-xs text-red-500" href="/auth/send-verification-code' + `?email=${email}` +'">ارسال مجدد کد تایید</a>')
        }
    }, 1000)

}

countDown()