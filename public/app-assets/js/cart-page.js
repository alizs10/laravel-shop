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

function cartPlus(product_id) {
    let input = $('#cart-product-' + product_id);
    let quantity = parseInt(p2eNumbers(input.val()));
    quantity++;
    input.val(e2pNumbers(quantity));

}

function cartMinus(product_id) {
    let input = $('#cart-product-' + product_id);
    let quantity = parseInt(p2eNumbers(input.val()));
    quantity = quantity <= 1 ? 1 : quantity - 1;
    input.val(e2pNumbers(quantity));

}