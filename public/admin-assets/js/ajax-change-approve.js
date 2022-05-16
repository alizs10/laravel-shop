
let approve = function (id) {
    var element = $('#approve-' + id);
    var elementDependant = $('#approve-d-' + id);
    var url = element.attr('data-url');
    
    $.ajax({
        type: "GET",
        url: url,
        data: "data",
        dataType: "json",
        success: function (response) {
            if (response.status) {
                if (response.approved) {
                    element.removeClass('button-success');
                    element.addClass('button-warning');
                    element.text('عدم تایید');
                    elementDependant.removeClass('text-warning');
                    elementDependant.addClass('text-success');
                    elementDependant.text('تایید شده');
                    alertify.set('notifier', 'position', 'top-left');
                    alertify.success('نظر تایید شد');
                }
                else {
                    element.removeClass('button-warning');
                    element.addClass('button-success');
                    element.text('تایید');
                    elementDependant.removeClass('text-success');
                    elementDependant.addClass('text-warning');
                    elementDependant.text('در انتظار تایید');
                    alertify.set('notifier', 'position', 'top-left');
                    alertify.success('نظر رد شد');
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
