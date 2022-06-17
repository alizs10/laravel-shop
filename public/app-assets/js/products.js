function addToFavorites(btn) {
    $(btn).toggleClass('text-red-500 text-gray-700')
}
function addToCart(btn) {

    var url = $(btn).attr('data-url')

    $.ajax({
        type: "get",
        url: url,

        success: function (response) {

            // increase cart number
            cartNumber = response.items.length;
            if(cartNumber == 0) {
                $('#cart-alert-number').addClass('hidden').removeClass('flex-center')
            } else {
                $('#cart-alert-number').removeClass('hidden').addClass('flex-center')
            }
            $('#cart-alert-number').html(cartNumber)


            // add product to cart
            console.log(response.items);

            // toggle btn
            if (response.status) {
                
                $(btn).find('svg').removeClass('fa-cart-circle-plus').addClass('fa-cart-circle-check')
            } else {
                $(btn).find('svg').removeClass('fa-cart-circle-check').addClass('fa-cart-circle-plus')

            }

        }
    });
}