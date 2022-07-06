import { Spinner } from '../packages/spin-js/spin.js';

var opts = {
    lines: 10, // The number of lines to draw
    length: 15, // The length of each line
    width: 10, // The line thickness
    radius: 45, // The radius of the inner circle
    scale: 0.2, // Scales overall size of the spinner
    corners: 1, // Corner roundness (0..1)
    speed: 1, // Rounds per second
    rotate: 0, // The rotation offset
    animation: 'spinner-line-fade-quick', // The CSS animation name for the lines
    direction: 1, // 1: clockwise, -1: counterclockwise
    color: '#fff', // CSS color or array of colors
    fadeColor: 'transparent', // CSS color or array of colors
    shadow: '0 0 1px transparent', // Box-shadow for the lines
    zIndex: 2000000000, // The z-index (defaults to 2e9)
    className: 'spinner', // The CSS class to assign to the spinner
    position: 'static', // Element positioning
};

export function checkCoupon(btn) {
    let url = $(btn).attr('data-url');
    let formData = {
        '_token': $('meta[name=csrf-token]').attr('content'),
        discount_code: ""
    }

    let discount_code = $('input[name="discount_code"]').val();
    formData.discount_code = discount_code;

    //loading
    var spinner = new Spinner(opts).spin();
    $(btn).html(spinner.el)

    $.ajax({
        type: "post",
        url,
        data: formData,
        dataType: "json",
        success: function (response) {
            console.log(response);
            $(btn).html("اعمال")
            $('#coupon-message').html(response.message)
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $(btn).html("اعمال")

        }
    });
}

window.greetFromModule = checkCoupon;

$("#check-coupon-btn").on("click", e => checkCoupon(e.target));

