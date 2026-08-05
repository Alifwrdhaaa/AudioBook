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
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
                wiggle: {
                    '0%, 100%': { transform: 'rotate(-3deg)' },
                    '50%': { transform: 'rotate(3deg)' },
                },
                'bounce-in': {
                    '0%': { transform: 'scale(0.5)', opacity: '0' },
                    '60%': { transform: 'scale(1.05)', opacity: '1' },
                    '100%': { transform: 'scale(1)', opacity: '1' },
                },
                'slide-up': {
                    '0%': { transform: 'translateY(20px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                'pop': {
                    '0%': { transform: 'scale(1)' },
                    '50%': { transform: 'scale(1.2)' },
                    '100%': { transform: 'scale(1)' },
                }
            },
            animation: {
                float: 'float 3s ease-in-out infinite',
                wiggle: 'wiggle 1s ease-in-out infinite',
                'bounce-in': 'bounce-in 0.5s cubic-bezier(0.68, -0.55, 0.26, 1.55)',
                'slide-up': 'slide-up 0.4s ease-out forwards',
                'pop': 'pop 0.3s ease-in-out',
            }
        },
    },

    plugins: [forms],
};
