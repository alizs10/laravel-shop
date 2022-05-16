
let changeTicketAdmin = function (id) {
    var element = $('#admin-' + id);
    var url = element.attr('data-url');

    $.ajax({
        type: "GET",
        url: url,
        data: "data",
        dataType: "json",
        success: function (response) {
            if (response.status) {
                if (response.set) {
                    element.removeClass('button-success');
                    element.addClass('button-danger');
                    element.text('حذف وظیفه');
                    alertify.set('notifier', 'position', 'top-left');
                    alertify.success('وظیفه اعمال شد');
                }
                else {
                    element.removeClass('button-danger');
                    element.addClass('button-success');
                    element.text('اعمال وظیفه');
                    alertify.set('notifier', 'position', 'top-left');
                    alertify.success('وظیفه گرفته شد');
                }
            }
            else {
                alertify.set('notifier', 'position', 'top-left');
                alertify.error('خطا ، دوباره امتحان کنید');
            }
        },
        error: function () {
            alertify.set('notifier', 'position', 'top-left');
            alertify.error('ارتباط با سرور برقرار نشد');
        }
    });

}
