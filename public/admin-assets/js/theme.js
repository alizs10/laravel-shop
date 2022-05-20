if (localStorage.getItem('themeMode') === 'dark') {
    $('#toggleThemeBtn').find('.fa-lightbulb-on').addClass('hidden');
    $('#toggleThemeBtn').find('.fa-lightbulb-slash').attr('data-prefix', 'fal').removeClass('hidden');
    $('#toggleThemeBtn span').html('حالت شب')
} else {
    $('#toggleThemeBtn').find('.fa-lightbulb-on').removeClass('hidden');
    $('#toggleThemeBtn').find('.fa-lightbulb-slash').attr('data-prefix', 'fal').addClass('hidden');
    $('#toggleThemeBtn span').html('حالت روز')
}



const toggleTheme = () => {
    if (localStorage.getItem('themeMode') === 'light') {
        localStorage.setItem('themeMode', 'dark')
        document.documentElement.classList.add('dark')
        $('#toggleThemeBtn').find('.fa-lightbulb-on').addClass('hidden');
        $('#toggleThemeBtn').find('.fa-lightbulb-slash').attr('data-prefix', 'fal').removeClass('hidden');
        $('#toggleThemeBtn span').html('حالت شب')
    } else {
        localStorage.setItem('themeMode', 'light')
        document.documentElement.classList.remove('dark')
        $('#toggleThemeBtn').find('.fa-lightbulb-on').attr('data-prefix', 'fal').removeClass('hidden');
        $('#toggleThemeBtn').find('.fa-lightbulb-slash').addClass('hidden');
        $('#toggleThemeBtn span').html('حالت روز')
    }

}