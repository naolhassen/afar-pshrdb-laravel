import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#eef7ff',
                    100: '#d9ecff',
                    200: '#bcdfff',
                    300: '#8ecbff',
                    400: '#59adff',
                    500: '#328bfc',
                    600: '#1c6cf1',
                    700: '#1455de',
                    800: '#1746b4',
                    900: '#193e8d',
                    950: '#142756',
                },
                accent: {
                    50: '#effef4',
                    100: '#d9fbe5',
                    200: '#b5f5cd',
                    300: '#7deba9',
                    400: '#3ed77d',
                    500: '#16bd5c',
                    600: '#0b9c49',
                    700: '#0c7a3c',
                    800: '#0f6133',
                    900: '#0e502c',
                    950: '#012d16',
                },
                flame: {
                    500: '#e6362e',
                    600: '#c92620',
                },
            },
        },
    },
    plugins: [],
};
