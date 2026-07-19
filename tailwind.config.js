import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#4F46E5', // Keep for legacy / admin
                secondary: '#06B6D4',
                success: '#22C55E',
                warning: '#F59E0B',
                background: '#F8FAFC',
                'duo-green': '#58CC02',
                'duo-green-dark': '#46A302',
                'duo-blue': '#1CB0F6',
                'duo-blue-dark': '#1899D6',
                'duo-yellow': '#FFC800',
                'duo-yellow-dark': '#D7A800',
                'duo-red': '#FF4B4B',
                'duo-red-dark': '#E53935',
                'duo-gray': '#E5E5E5',
                'duo-gray-dark': '#CECECE',
            }
        },
    },

    plugins: [forms],
};
