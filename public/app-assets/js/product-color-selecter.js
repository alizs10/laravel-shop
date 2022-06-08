var productColors = $('#product-colors span')

productColors.on('click', colorSelector);
var check = ' <i class="fa-regular fa-check text-lg text-black dark:text-white"></i>';

function colorSelector()
{
    let selected = $('#product-colors').find('.selected');
    selected.removeClass('selected');
    selected.find('svg').remove()
    selected.find('div').removeClass('hidden')
    $(this).addClass('selected')
    $(this).find('div').addClass('hidden')
    $(this).prepend(check);
}