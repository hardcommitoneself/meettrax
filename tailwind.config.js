const colors = require('tailwindcss/colors')

module.exports = {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    safelist: [
        {
            // gender sport colors
            pattern: /text-(|blue|pink|green)-(500)/,
        }
        ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Titillium Web'],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
