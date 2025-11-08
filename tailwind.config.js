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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            // ✅ Custom Colors
            colors: {
                primary: {
                    DEFAULT: '#0FA64B',
                    light: '#1ad564',
                    dark: '#0b7535',   
                },
                grey: {
                    DEFAULT: '#aeb0b5', // purple-600
                    light: '#E7E9F5',   // purple-400
                    dark: '#6c6d70',    // purple-700
                },
                accent: '#F59E0B', // amber-500
                neutral: '#374151', // gray-700
            },

            // ✅ Custom Breakpoints (screens)
            screens: {
                xs: '480px',
                sm: '640px',
                md: '768px',
                lg: '1024px',
                xl: '1280px',
                '2xl': '1536px',
                '3xl': '1920px', // Extra large custom breakpoint
            },
        },
    },

    plugins: [forms],
};
