function compareProductsToggle() {
    if ($('#compare-products-backdrop').hasClass('hidden')) {
        $('body').addClass('overflow-hidden')
        $('#compare-products-backdrop').css("top", "100%")
        $('#compare-products-backdrop').removeClass('hidden').addClass('flex-center')
        $("#compare-products-backdrop").animate({ top: "0" }, 50);
    } else {
        $("#compare-products-backdrop").animate({ top: "100%" }, 200, null, function () {
            $('body').removeClass('overflow-hidden')
            $('#compare-products-backdrop').addClass('hidden').removeClass('flex-center')
        })
    }
}