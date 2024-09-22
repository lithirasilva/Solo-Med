import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                primary: '#F97316', // orange-600
                secondary: '#F5F5F5', // light gray for background contrast
                accent: '#FF6F00', // a slightly different shade of orange for accents
                text: '#333333', // dark gray for readable text
                border: '#E0E0E0', // light gray for borders
            },
            fontFamily: {
                sans: ['Montserrat', ...defaultTheme.fontFamily.sans], // Elegant sans-serif
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif], // Elegant serif
            },
            boxShadow: {
                'outline': '0 0 0 3px rgba(255, 145, 0, 0.5)', // Outline shadow for focus
                'button': '0 4px 6px rgba(0, 0, 0, 0.1)', // Button shadow
            },
            borderRadius: {
                'lg': '0.5rem', // Large rounded corners for buttons and inputs
            },
            spacing: {
                '128': '32rem', // Custom spacing utility if needed
            },
        },
    },

    plugins: [forms, typography],
};
