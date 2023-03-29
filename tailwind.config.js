const defaultTheme = require('tailwindcss/defaultTheme');

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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            backgroundColor: {
                'primary': '#d4bfa3', // your primary color
                'secondary': '#eac27f', // your secondary color
                'accent': '#bdb9ac', // your accent color
            },
            textColor: {
                'primary': '#7d9d95', // your primary text color
                'secondary': '#e2e8f0', // your secondary text color
            },



            plugins: [require('@tailwindcss/forms'), require('flowbite/plugin')],
        }
    }

}
