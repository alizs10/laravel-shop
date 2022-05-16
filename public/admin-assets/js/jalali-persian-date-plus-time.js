$(document).ready(function () {
    $('#published_at_view').persianDatepicker({
        observer: true,
        format: 'YYYY/MM/DD',
        altField: '#published_at',
        timePicker: {
            enabled: true,
            meridiem: {
                enabled: true
            }
        }
    });
});