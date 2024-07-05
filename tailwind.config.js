/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/**/*.blade.php',
        './resources/views/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                'black': '#060606',
            },

            fontFamily: {
                'hanken-grotesk': ['Hanken Grotesk', 'sans-serif'],
            },
            fontSize: {
                '2xs': '.625rem' /* 10px */,
            }
        },
    },
    plugins: [],
}

