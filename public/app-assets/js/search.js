let searchWinVisibility = false;

function toggleSearchWindow() {
    $('#search-window').toggleClass('hidden')
    $('body').toggleClass('overflow-hidden')
    if (!searchWinVisibility) {
        searchWinVisibility = true
        $('#search-input').focus();
    } else {
        searchWinVisibility = false
    }
}

function handleSearchInp() {
    $('#search-inp-value').parent().removeClass('hidden')
    $('#search-inp-value').html('"' + + '"')
    $('#search-inp-value').html(`"${$('#search-input').val()}"`)

    searchFor($('#search-input').val())
}

function searchFor(word) {
    let base_url = window.location.origin;
    let url = base_url + "/search?search=" + word;
    $.ajax({
        type: "get",
        url,
        success: function (response) {
            console.log(response);
        }
    });
}