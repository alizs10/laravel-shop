const print = (id) => {
    var body = $('body').html();
    var printable = $('#' + id).clone();
    $('body').empty().html(printable)
    window.print();
    $('body').html(body)
}