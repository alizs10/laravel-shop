$(document).ready(function () {
    $('#valid_from_view').persianDatepicker({
        observer: true,
        format: 'YYYY/MM/DD',
        altField: '#valid_from'
    });
});
$(document).ready(function () {
    $('#valid_until_view').persianDatepicker({
        observer: true,
        format: 'YYYY/MM/DD',
        altField: '#valid_until'
    });
});