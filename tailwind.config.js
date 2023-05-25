const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    orange: '#F08507',
                },
                secondary: {
                    light_orange : '#F8BC76',
                    dark_brown: '#A65C06',
                    bg_modal: '#fafafa',
                }
            },
            
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
