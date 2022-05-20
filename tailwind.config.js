const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  darkMode: 'class',
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './vendor/laravel/jetstream/**/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
  ],

  theme: {
    extend: {
      fontFamily: {
        'sans': ['iransans']
      },
      fontSize: {
        'xxs': ['10px', {
          letterSpacing: '-0.01em',
        }],
        'xxxs': ['8px', {
          letterSpacing: '-0.01em',
        }],
      }
    },
    screens: {
      'xs': '400px',
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
    },

  },

  plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
