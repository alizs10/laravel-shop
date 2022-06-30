function colorSelector(colorBtn) {
    let check = ' <i class="fa-regular fa-check text-lg text-black dark:text-white"></i>';

    let selected = $('#product-colors').find('.selected');
    selected.removeClass('selected');
    selected.find('svg').remove()
    selected.find('div').removeClass('hidden')
    $(colorBtn).addClass('selected')
    $(colorBtn).find('div').addClass('hidden')
    $(colorBtn).prepend(check);

    let url = $(colorBtn).attr('data-url');
    console.log(url);
    let formData = {
        '_token': $('meta[name=csrf-token]').attr('content'),
        'attributes': []
    };

    let attributes = $('input[name^="product_attributes"]')
    attributes.each(function (key, value) {
        formData['attributes'][key] = value.value
    })


    $.ajax({
        type: "post",
        url,
        data: formData,
        dataType: "json",
        success: function (response) {
            $('#product-price').html(response.product_price + ' تومان')
            $('#ultimate-price').html(response.ultimate_price + ' تومان')
            
        }
    });

}