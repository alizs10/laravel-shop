function addToFavorites(btn) {
    $(btn).toggleClass('text-red-500 text-gray-700')
}
function addToCart(btn) {

    var url = $(btn).attr('data-url')

    $.ajax({
        type: "get",
        url: url,

        success: function (response) {
            console.log(response.items);
            // increase cart number
            cartNumber = response.items.length;
            if (cartNumber == 0) {
                $('#cart-alert-number').addClass('hidden').removeClass('flex-center')
            } else {
                $('#cart-alert-number').removeClass('hidden').addClass('flex-center')
            }
            $('#cart-alert-number').html(cartNumber)


            // add product to cart

            if (response.items.length == 0) {
                let emptyCart = `<span id='cart-dropdown-empty' class="py-3 flex flex-col justify-center gap-3">
                                    <i class="fa-light fa-cart-circle-xmark text-4xl md:text-6xl"></i>
                                    <span class="text-xs"> سبد خرید شما خالیه :(</span>
                                </span>`;

                $('#cart-dropdown-items').remove();
                $('#cart-dropdown-price').remove();
                $('#cart-dropdown').append(emptyCart);
            } else {

                let cartContainerStart = `
                        <div
                            class="flex justify-between items-center border-b-2 dark:border-gray-700 border-gray-100 text-xs py-3">
                            <span class="mr-2">${cartNumber} کالا</span>
                            <a href="" class="text-blue-600 dark:text-blue-400 flex items-center gap-x-2 ml-2">
                                برو به سبد خرید
                                <i class="fa-duotone fa-arrow-left"></i>
                            </a>
                        </div>

                            <ul id="cart-dropdown-items" class="flex flex-col">`;

                let cartContainerEnd = `
                            </ul>

                            <div id="cart-dropdown-price" class="flex flex-col gap-3 pt-2 border-t-2 border-gray-100 dark:border-gray-700">

                                
                                <span class="flex justify-between text-xs mx-2">
                                    <span>جمع سبد خرید شما :</span>
                                    <span>${response.pay_price} تومان</span>
                                </span>
                                <span class="flex justify-between text-xs mx-2 text-red-500">
                                    <span>تخفیف ها</span>
                                    <span>${response.discount_price} تومان</span>
                                </span>
                                <span class="flex justify-between text-xs mx-2">
                                    <span>مبلغ پرداختی</span>
                                    <span>${response.total_pay_price} تومان</span>
                                </span>

                                <a href="" class="btn text-sm bg-emerald-700 text-white m-2">ثبت سفارش</a>
                            </div>
                            `;


                let cartContainer = cartContainerStart + itemGenerator(response.items) + cartContainerEnd;         

                $('#cart-dropdown').html(cartContainer);
                
            }
            // toggle btn
            if (response.status) {

                $(btn).find('svg').removeClass('fa-cart-circle-plus').addClass('fa-cart-circle-check')
            } else {
                $(btn).find('svg').removeClass('fa-cart-circle-check').addClass('fa-cart-circle-plus')

            }

        }
    });
}

function itemGenerator(items) {
    let itemContainer = '';

    for (let i = 0; i < items.length; i++) {
        var base_url = window.location.origin;
        let item = items[i];
        itemContainer += `
        <li
            class="grid grid-cols-6 gap-2 items-center py-2 border-b dark:border-gray-700 last:border-none hover-transition hover:bg-gray-100 dark:hover:bg-gray-700">
            <div class="col-span-2 mr-2 rounded-lg overflow-hidden">
            <img class="w-full"
                src="${base_url}/storage/${item.product.image['indexArray']['medium']}"
                alt="">
            </div>
            <div class="col-span-3 text-right">
                <span class="text-xs leading-6">${item.product.name}</span>
            </div>
            <span class="col-span-1 text-red-500 ml-2">
                <i class="fa-duotone fa-trash-list"></i>
            </span>
        </li>
        `
        
    }

    return itemContainer;
}