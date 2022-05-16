
let changeUserType = function (id) {
    var element = $('#user-' + id);
    var url = element.attr('data-url');

    $.ajax({
        type: "GET",
        url: url,
        data: "data",
        dataType: "json",
        success: function (response) {
            if (response.status) {
                if (response.admin) {
                    element.removeClass('button-success');
                    element.addClass('button-danger');
                    element.text('حذف ادمین');
                    alertify.set('notifier', 'position', 'top-left');
                    alertify.success('به ادمین ها اضافه شد');
                }
                else {
                    element.removeClass('button-danger');
                    element.addClass('button-success');
                    element.text('ادمین شو');
                    alertify.set('notifier', 'position', 'top-left');
                    alertify.success('حذف ادمین');
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
