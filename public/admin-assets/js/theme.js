const toggleTheme = () => {
    if (localStorage.getItem('themeMode') === 'light') {
        localStorage.setItem('themeMode', 'dark')
        document.documentElement.classList.add('dark')
    } else {
        localStorage.setItem('themeMode', 'light')
        document.documentElement.classList.remove('dark')
    }

}