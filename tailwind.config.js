const defaultTheme = require('tailwindcss/defaultTheme');
const { colors } = require('tailwindcss/defaultTheme')
module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                'dark': {'raw': '(prefers-color-scheme: dark)'},
                // => @media (prefers-color-scheme: dark) { ... }
            },
            colors: {
                blue: {
                    ...colors.blue,
                    'deep': '#007acc',
                },
                gray: {
                    ...colors.gray,
                    '1000': '#3e3e42',
                    '2000': '#2d2d30',
                    '3000': '#252526',
                    '4000': '#1e1e1e',
                }
            }
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [require('@tailwindcss/ui')],
};
