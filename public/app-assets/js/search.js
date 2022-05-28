let searchWinVisibility = false;

function toggleSearchWindow() {
    $('#search-window').toggleClass('hidden')
    if (!searchWinVisibility) {
        searchWinVisibility = true
        $('#search-input').focus();
    } else {
        searchWinVisibility = false
    }
}

function handleSearchInp() {
    $('#search-inp-value').parent().removeClass('hidden')
    $('#search-inp-value').html('"' + $('#search-input').val() + '"')
}