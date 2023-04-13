const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')
/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./node_modules/flowbite/**/*.js",
        'node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx}',
    ],

    theme: {
        extend: {
            fontFamily: {
                sansSerif:['Verlag','sans-serif'],
            },

            backgroundColor: {
                'primary': '#70442c', // your primary color
                'secondary': '#d0c4a4', // your secondary color
                 // your accent color
            },
            textColor: {
                'primary': 'black', // your primary text color
                'secondary': '#70442c', // your secondary text color
                'accent': '#d0c4a4',
            },
            colors: {
                gray: colors.gray,
                blue: colors.sky,
                red: colors.rose,
                pink: colors.fuchsia,
                yellow:colors.yellow
              },
            borderColor:'brown',

            plugins: [require('@tailwindcss/forms'), require('flowbite/plugin')],
        }
    }

}
