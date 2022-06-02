var categories = $('#categories');
function toggleSidebar() {
    $('aside').toggleClass('-right-full').toggleClass('right-0')
    $('#blur-back').toggleClass('hidden')
}


$('#toggleCategories').on('mouseenter', function () {
    // check if screen is large

    if (window.innerWidth > 1024) {
        categories.addClass('lg:grid');
        $('#blur-back').toggleClass('hidden lg:hidden')
    }
});

$('#toggleCategories').on('mouseleave', function (event) {
    var target = $(event.toElement)[0];
    if (window.innerWidth > 1024 && categories.find(target).length == 0) {
        categories.removeClass('lg:grid')
        $('#blur-back').toggleClass('hidden lg:hidden')
    }

});



categories.on('mouseleave', function () {
    if (window.innerWidth > 1024) {
        categories.removeClass('lg:grid')
        $('#blur-back').toggleClass('hidden lg:hidden')
    }
})

$('.cat').hover(function () {
    let id = $(this).attr('id');
    id = id.slice(2, id.length);

    if (!$('#c-s-' + id).hasClass('c-s-active')) {
        $('.c-s-active').toggleClass('hidden c-s-active');
        $('#c-s-' + id).toggleClass('hidden c-s-active');

        $('.cat-active').toggleClass('text-red-500 cat-active')
        $(this).toggleClass('cat-active text-red-500')
    }


}
);

$('.s-cat').click(function () {
    let id = $(this).attr('id');
    console.log(id);

    id = id.slice(4, id.length);

    $(this).toggleClass('text-red-500')
    $(this).find('svg').toggleClass('fa-angle-left fa-angle-down')
    console.log(id);
    $('#s-c-s-' + id).toggleClass('hidden');

}
);