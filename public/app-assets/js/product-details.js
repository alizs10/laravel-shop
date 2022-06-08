var isFullDetails = false;

$('#show-full-product-details').on('click', () => {
    let ol = $('#show-full-product-details').parent().parent();
    if (!isFullDetails) {
        isFullDetails = true;
        $('#show-full-product-details span').html('بستن مشخصات');
        ol.find('.hidden').removeClass('hidden');
    } else {
        isFullDetails = false;
        $('#show-full-product-details span').html('مشاهده کامل مشخصات کالا');
        for (let i = ol.find('li').length; i > 5; i--) {

            ol.find('li').eq(i-2).addClass('hidden');
            
        }
    }
    $('#show-full-product-details').find('svg').toggleClass('fa-angle-down fa-angle-up')
    
})