function toggleAddNewAddress() {
    $('body').toggleClass('overflow-hidden')
    $('#new-address-backdrop').toggleClass('hidden flex-center')
}

function setDefaultAddress(address, addrss_id) {
    if ($(address).hasClass('selected-address')) return;

    url = $(address).attr('data-url')
    $.ajax({
        type: "get",
        url,
        success: function (response) {

            let selectedAddressBtnContainer = `
                <i class="fa-regular fa-check text-lg"></i>
                    پیش فرض`;

            $('.selected-address').html('انتخاب پیش فرض')
            $('.selected-address').removeClass('selected-address')
            $(address).addClass('selected-address')
            $(address).html(selectedAddressBtnContainer)

        }
    });

}

function profileBack() {
    $('#profile-section').toggleClass('hidden')
    $('#addresses-section').toggleClass('hidden')
}

$('#province').on('change', getCities)

function getCities() {
    let province_id = $('#province').val();
    if (province_id == '') return;
    let base_url = window.location.origin;
    let url = base_url + '/provinces/' + province_id + '/cities';

    $.ajax({
        type: "get",
        url,
        success: function (response) {
            printCities(response.cities)
        }
    });
}


function printCities(cities) {

    let citiesContainer = '<option class="text-black" value="">شهر خود را انتخاب کنید</option>';

    for (let i = 0; i < cities.length; i++) {
        const city = cities[i];
        citiesContainer += `<option class="text-black" value="${city.id}">${city.name}</option>`;
    }

    console.log(citiesContainer);

    $('#city_id').html(citiesContainer);
}