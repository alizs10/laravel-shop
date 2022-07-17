function toggleAddNewTicket()
{
    if ($('#new-ticket-backdrop').hasClass('hidden')) {
        $('body').addClass('overflow-hidden')
        $('#new-ticket-backdrop').css("opacity", "0")
        $('#new-ticket-backdrop').removeClass('hidden').addClass('flex-center')
      
        $('#new-ticket-backdrop').animate({ opacity: "1" }, 50);
    } else {
        $('#new-ticket-backdrop').animate({ opacity: "0" }, 200, null, function () {
            $('body').removeClass('overflow-hidden')
            $('#new-ticket-backdrop').addClass('hidden').removeClass('flex-center')
        })
    }
}

function profileBack()
{
    $('#profile-section').toggleClass('hidden')
    $('#tickets-section').toggleClass('hidden')
}