
let changeTicketAdmin = function (id) {
    var element = $('#admin-' + id);
    var url = element.attr('data-url');
    $(this).find('svg').addClass('text-xl');
    var icon =  element.find('svg')

    $.ajax({
        type: "GET",
        url: url,
        data: "data",
        dataType: "json",
        success: function (response) {
            if (response.status) {
               
                if (response.set) {
                    element.toggleClass('bg-red-400').toggleClass('bg-emerald-400')
                    icon.removeClass('fa-user-check').addClass('fa-user-minus')
                    element.find('span').text('حذف وظیفه');
                    alertify.set('notifier', 'position', 'top-left');
                    alertify.success('وظیفه اعمال شد');
                }
                else {
                    element.toggleClass('bg-red-400').toggleClass('bg-emerald-400')
                    icon.removeClass('fa-user-minus').addClass('fa-user-check')
                    element.find('span').text('اعمال وظیفه');
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
