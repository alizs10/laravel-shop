function addToFavorites(btn) {

    let url = $(btn).attr('data-url');
    $.ajax({
        type: "get",
        url,
        success: function (response) {
            if (response.status) {
                $(btn).removeClass('text-gray-700').addClass('text-red-500')
            } else {
                if (response.redirect) {
                    window.location(response.url)
                }
                $(btn).removeClass('text-red-500').addClass('text-gray-700')
            }
        },
        error: function (response) {
            if (response.status == 401) {
                window.location = window.location.origin + '/login';
            }
        }
    });


}



function addToCart(btn) {

    var url = $(btn).attr('data-url')
    let formData = {
        '_token': $('meta[name=csrf-token]').attr('content'),
        'attributes': {
            'category_values': {},
            'color_id': null,
            'guaranty_id': null,
        },
        'has_defaults_attributes': false,

    };

    let attributes = $('select[name^="product_attributes"]')
    let color_id = $('input[name="color_id"]')

    if (color_id.length > 0) {
        formData['attributes']['color_id'] = color_id[0].value
    }

    if (attributes.length > 0) {
        attributes.each(function (key, value) {
            formData['attributes']['category_values'][key] = value.value
        })
    } else {
        formData['has_defaults_attributes'] = true;
    }


    $.ajax({
        type: "post",
        url: url,
        data: formData,
        dataType: "json",
        success: function (response) {
            // increase cart number
            cartNumber = response.cart_count;
            if (response.items.length == 0) {
                $('#cart-alert-number').addClass('hidden').removeClass('flex-center')
            } else {
                $('#cart-alert-number').removeClass('hidden').addClass('flex-center')
            }
            $('#cart-alert-number').html(cartNumber)
            $('#cart-count').html(cartNumber + " کالا")


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
                            <span id="cart-count" class="mr-2">${cartNumber} کالا</span>
                            <a href="/cart" class="text-blue-600 dark:text-blue-400 flex items-center gap-x-2 ml-2">
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

                                <a href="/cart" class="btn text-sm bg-emerald-700 text-white m-2">ثبت سفارش</a>
                            </div>
                            `;


                let cartContainer = cartContainerStart + itemGenerator(response.items) + cartContainerEnd;

                $('#cart-dropdown').html(cartContainer);

            }
            // toggle btn

            if ($(btn).attr('id') === 'product-toggle-product-btn') {
                if (response.status) {
                    $('#product-toggle-product-btn span').find('svg').removeClass('fa-plus').addClass('fa-check')
                    $('#product-toggle-product-btn span').find('span').html('موجود در سبد شما')
                } else {
                    $('#product-toggle-product-btn span').find('svg').removeClass('fa-check').addClass('fa-plus')
                    $('#product-toggle-product-btn span').find('span').html('افزودن به سبد خرید')
                }
            } else {
                if (response.status) {

                    $(btn).find('svg').removeClass('fa-cart-circle-plus').addClass('fa-cart-circle-check')
                } else {
                    $(btn).find('svg').removeClass('fa-cart-circle-check').addClass('fa-cart-circle-plus')

                }
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
            <a href="/cart/destroy/${item.id}" class="col-span-1 text-red-500 ml-2">
                <i class="fa-duotone fa-trash-list"></i>
            </a>
        </li>
        `

    }

    return itemContainer;
}

