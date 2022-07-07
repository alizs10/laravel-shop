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

    let base_url = window.location.origin;

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

            if (response.status) {
                $('input[name="discount_code"]').val("")
                $('#coupon-container').remove()
                $('#coupon-price-container').remove()
                $("#price-container").children().eq(0).removeClass('md:pb-2 md:border-b-2 border-gray-200 dark:border-gray-700')
                $("#container").children().eq(2).after(`<div id="coupon-container" class="flex gap-2 items-center text-xs xs:text-sm">
                <span class="text-red-500">کوپن: ${response.coupon.code}</span>
                <a class="text-gray-500 dark:text-gray-400" href="${base_url + '/payment/' + response.order.id + '/remove-coupon/' + response.coupon.id}">حذف</a>
            </div>`)
                $("#price-container").children().eq(0).after(`
                <span
                    class="text-red-500 flex justify-between items-center md:pb-2 md:border-b-2 border-gray-200 dark:border-gray-700">
                    <span>تخفیف</span>
                    <span>${response.order_coupon_discount_amount} تومان</span>
                </span>`)
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            $(btn).html("اعمال")

        }
    });
}

window.greetFromModule = checkCoupon;

$("#check-coupon-btn").on("click", e => checkCoupon(e.target));

