const toggleDropdown = (id) => {

    var toggleBtn = $('#toggle-' + id)
    var arrow = $('#toggle-' + id + ' svg')
    var dropdown = $('#' + id)
    toggleBtn.toggleClass('toggle-active')
    dropdown.toggleClass('hidden')
    arrow.toggleClass('rotate-180')
}