function addToFavorites(btn)
{
    $(btn).toggleClass('text-red-500 text-gray-700')
}
function addToCart(btn)
{
    $(btn).find('svg').toggleClass('fa-cart-circle-check fa-cart-circle-plus')
}