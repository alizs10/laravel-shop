function getPrice(url) {

    let formData = {
        '_token': $('meta[name=csrf-token]').attr('content'),
        'attributes': [],
        'color_id': null
    };

    let attributes = $('select[name^="product_attributes"]')
    let color_id = $('input[name="color_id"]')

    if (color_id.length > 0) {
        formData['color_id'] = color_id[0].value
    }

    attributes.each(function (key, value) {
        formData['attributes'][key] = value.value
    })

    return $.ajax({
        type: "post",
        url,
        data: formData,
        dataType: "json",
        success: function (response) {
            return response;
        }
    });
}

async function changeAttributeValue(attr) {
    let url = $(attr).attr('data-url');
    let res = await getPrice(url)

    if (res) {
        $('#product-price').html(res.product_price + ' تومان')
        $('#ultimate-price').html(res.ultimate_price + ' تومان')
    }
}

async function colorSelector(colorBtn, color_id) {
    let check = ' <i class="fa-regular fa-check text-lg text-black dark:text-white"></i>';
    let selected = $('#product-colors').find('.selected');
    $('input[name="color_id"]').val(color_id);

    let url = $(colorBtn).attr('data-url');
    let res = await getPrice(url)

    if (res) {
        $('#product-price').html(res.product_price + ' تومان')
        $('#ultimate-price').html(res.ultimate_price + ' تومان')

        selected.removeClass('selected');
        selected.find('svg').remove()
        selected.find('div').removeClass('hidden')
        $(colorBtn).addClass('selected')
        $(colorBtn).find('div').addClass('hidden')
        $(colorBtn).prepend(check);
    }

}