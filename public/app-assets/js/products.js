function addToFavorites(btn) {
    $(btn).toggleClass('text-red-500 text-gray-700')
}
function addToCart(btn) {

    var url = this.attr('data-url')

    $.ajax({
        type: "POST",
        url: url,

        success: function (response) {
            // increase cart number
            
            $('#cart-alert-number').html(response.cartNumber)


            // add product to cart


            // toggle btn

            $(btn).find('svg').toggleClass('fa-cart-circle-check fa-cart-circle-plus')

        }
    });
}