/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php'
    ],
    theme: {
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.violet,
                success: colors.emerald,
                warning: colors.amber,
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
