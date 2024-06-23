import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        container: {
            center: true,
            padding: {
                default: '1rem',
                sm: '2rem',
                lg: '3rem',
                xl: '4rem',
            },
        },
        extend: {
            fontFamily: {
                sans: ['Inter var', 'Noto Sans TC', ...defaultTheme.fontFamily.sans],
                mono: [...defaultTheme.fontFamily.mono, 'Inter var', 'Noto Sans TC']
            },
        },
    },
    plugins: [forms],
};
