$(document).ready(function () {
    
    let element = $('.delBtn');

    element.on('click', function (e) {
        e.preventDefault();
    
        var thisElement = $(this);
        alertify.confirm("حذف داده", "آیا از حذف این داده اطمینان دارید؟",
            function () {
                thisElement.parent().submit();
            },
            function () {
                alertify.error('انصراف');
            }).set(
                'labels', {
                ok: 'حذف',
                cancel: "انصراف"
            });
    })




});