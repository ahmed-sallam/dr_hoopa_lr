import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                lato: ["Lato", "sans-serif"],
                "noto-kufi-arabic": ["Noto Kufi Arabic", "sans-serif"],
            },
            colors: {
                'primary': '#007bff',
                'secondary': '#6c757d',
                'success': '#28a745',
                'danger': '#dc2626',
                'warning': '#ffc107',
                'info': '#17a2b8',
                'light': '#f8f9fa',

            },
        },

        plugins: [forms, require('flowbite/plugin'), require('tailwindcss-rtl')],
    }
}
