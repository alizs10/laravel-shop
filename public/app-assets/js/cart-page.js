function e2pNumbers(number) {
    number = number.toString();
    let persianNumbers = ['۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۰']
    let englishNumbers = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0']
    for (let i = 0; i < englishNumbers.length; i++) {
        let reg = new RegExp(englishNumbers[i], "g");
        number = number.replace(reg, persianNumbers[i])
    }

    return number;
}
function p2eNumbers(number) {
    let persianNumbers = ['۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۰']
    let englishNumbers = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0']
    for (let i = 0; i < persianNumbers.length; i++) {
        let reg = new RegExp(persianNumbers[i], "g");
        number = number.replace(reg, englishNumbers[i])
    }

    return number;
}

function priceFormatter(price) {
    let formated_price = parseInt(price).toLocaleString('en-US')
    return e2pNumbers(formated_price);
 }
 

function cartPlus(btn ,product_id) {
    let input = $('#cart-product-' + product_id);
    let quantity = parseInt(p2eNumbers(input.val()));
    let url = $(btn).attr('data-url');
    console.log(url);
    $.ajax({
        type: "get",
        url,
        success: function (response) {
            input.val(e2pNumbers(response.number));
            $('#pay_price').html(`${priceFormatter(response.pay_price)} تومان`)
            $('#discount_price').html(`${priceFormatter(response.discount_price)} تومان`)
            $('#total_pay_price').html(`${priceFormatter(response.total_pay_price)} تومان`)
        },
    });

}

function cartMinus(btn ,product_id) {
    let input = $('#cart-product-' + product_id);
    let quantity = parseInt(p2eNumbers(input.val()));
    let url = $(btn).attr('data-url');
    $.ajax({
        type: "get",
        url,
        success: function (response) {
            input.val(e2pNumbers(response.number));
            $('#pay_price').html(`${priceFormatter(response.pay_price)} تومان`)
            $('#discount_price').html(`${priceFormatter(response.discount_price)} تومان`)
            $('#total_pay_price').html(`${priceFormatter(response.total_pay_price)} تومان`)
        },
    });


}