function toggleAddNewAddress()
{
    $('body').toggleClass('overflow-hidden')
    $('#new-address-backdrop').toggleClass('hidden flex-center')
}

function setDefaultAddress(address)
{
    if ($(address).hasClass('selected-address')) return;

    let selectedAddressBtnContainer = `
    <i class="fa-regular fa-check text-lg"></i>
    پیشفرض
    `;

    $('.selected-address').html('انتخاب پیشفرض')
    $('.selected-address').removeClass('selected-address')
    $(address).addClass('selected-address')
    $(address).html(selectedAddressBtnContainer)
}

function profileBack()
{
    $('#profile-section').toggleClass('hidden')
    $('#addresses-section').toggleClass('hidden')
}