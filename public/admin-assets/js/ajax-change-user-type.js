
let changeUserType = function (id) {
    var element = $('#user-' + id);
    var url = element.attr('data-url');
    var icon =  element.find('svg')
    $.ajax({
        type: "GET",
        url: url,
        data: "data",
        dataType: "json",
        success: function (response) {
            if (response.status) {
                if (response.admin) {
                    element.toggleClass('bg-red-400').toggleClass('bg-emerald-400')
                    icon.removeClass('fa-user-check').addClass('fa-user-minus')
                    element.find('span').text('حذف ادمین');
                    alertify.set('notifier', 'position', 'top-left');
                    alertify.success('به ادمین ها اضافه شد');
                }
                else {
                    element.toggleClass('bg-red-400').toggleClass('bg-emerald-400')
                    icon.removeClass('fa-user-minus').addClass('fa-user-check')
                    element.find('span').text('ادمین شو');
                    alertify.set('notifier', 'position', 'top-left');
                    alertify.success('از لیست ادمین ها حذف شد');
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
