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
                // primary: "rgba(var(--primary))",
                'primary': '#033468',
                'secondary': '#1877F2',
                'accent2': "rgba(var(--accent2))",
                'accent':'#d5d5d5',
                'success': '#19b500',
                'danger': '#ff0000',
                'warning': '#ffd914',
                'info': '#17a2b8',
                'light': '#f8f9fa',
                'dark': 'rgba(var(--dark))',
                'dark2': '#252424',
                'white': '#ffffff',
            },
        },

        plugins: [forms, require('flowbite/plugin'), require('tailwindcss-rtl')],
    }
}
