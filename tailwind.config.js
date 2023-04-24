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
        screens:{
            'tablet': '640px',
      // => @media (min-width: 640px) { ... }

      'laptop': '1024px',
      // => @media (min-width: 1024px) { ... }

      'desktop': '1280px',
      // => @media (min-width: 1280px) { ... }
    },


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
            colors:{
                'brown':"#70442c",
                'beige':"#d0c4a4",
            },
            borderColor:'brown',

            plugins: [require('@tailwindcss/forms'), require('flowbite/plugin')],
        }
    }
}

