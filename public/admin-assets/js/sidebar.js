const toggleSidebar = () => {
    $('#toggleSidebar svg').toggleClass('fa-bars-staggered').toggleClass('fa-xmark')
    $('#sidebar').toggleClass('toggleSidebar')
}

const toggleSidebarDropdownBtn = (btn) => {
    $(btn).toggleClass('sidebar-active')
    $(btn).find('.angle').toggleClass('-rotate-90')
    $(btn).find('.dropdown').toggleClass('hidden').toggleClass('flex')

}