function toggleAddNewAddress() {
    $('body').toggleClass('overflow-hidden')
    $('#new-address-backdrop').toggleClass('hidden flex-center')
}

function selectAddress(address) {
    if ($(address).hasClass('selected-address')) return;

    let url = $(address).attr('data-url');

    $.ajax({
        type: "get",
        url,
        success: function (response) {
            if (response.status) {
                let selectedAddressBtnContainer = `
                <i class="fa-regular fa-check text-lg"></i>
                انتخاب شده
                `;

                $('.selected-address').html('انتخاب')
                $('.selected-address').removeClass('selected-address')
                $(address).addClass('selected-address')
                $(address).html(selectedAddressBtnContainer)
            }
        }
    });

}

function selectDelivery(delivery) {
    if ($(delivery).hasClass('selected-delivery')) return;


    let url = $(delivery).attr('data-url');

    $.ajax({
        type: "get",
        url,
        success: function (response) {
            if (response.status) {
                $('.selected-delivery').addClass('bg-gray-200 dark:bg-gray-700')
                $('.selected-delivery').removeClass('selected-delivery bg-red-500 text-white')
                $(delivery).removeClass('bg-gray-200 dark:bg-gray-700')
                $(delivery).addClass('selected-delivery bg-red-500 text-white')
                $('#delivery_amount').html(response.delivery_amount + ' تومان')
                $('#pay_price').html(response.pay_price + ' تومان')
            }
        }
    });

}

