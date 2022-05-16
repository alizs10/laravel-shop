
let commentable = function (id) {
    var element = $('#commentable-' + id);
    var url = element.attr('data-url');
    var elementCurrentValue = !element.prop('checked');

    $.ajax({
        type: "GET",
        url: url,
        data: "data",
        dataType: "json",
        success: function (response) {
            if (response.status) {
                if (response.checked) {
                    element.prop('checked', true);
                    alertify.set('notifier', 'position', 'top-left');
                    alertify.success('نظرات با موفیقت فعال شد');
                }
                else {
                    element.prop('checked', false);
                    alertify.set('notifier', 'position', 'top-left');
                    alertify.success('نظرات با موفیقت غیرفعال شد');
                }
            }
            else {
                element.prop('checked', elementCurrentValue);
                alertify.set('notifier', 'position', 'top-left');
                alertify.error('خطا در تغییر نظرات، دوباره امتحان کنید');
            }
        },
        error: function () {
            element.prop('checked', elementCurrentValue);
            alertify.set('notifier', 'position', 'top-left');
            alertify.error('ارتباط با سرور برقرار نشد');
        }
    });

}
