module.exports = {
    future: {
        removeDeprecatedGapUtilities: true,
    },
    plugins: [
        require('@tailwindcss/ui'),
        require('@tailwindcss/typography'),
    ],
    purge: [
        './**/*.php',
        './src/**/*.tsx',
    ],
    theme: {
        extend: {
            maxHeight: {
                '0': '0',
                '1/4': '25%',
                '1/2': '50%',
                '3/4': '75%',
                'full': '100%',
                '300': '300px',
                '500': '500px'
            },
            maxWidth: {
                '1/4': '25%',
                '1/2': '50%',
                '3/4': '75%',
                '300': '200px'
            }
        },

    },
    // variants: ['responsive', 'group-hover', 'disabled', 'hover', 'focus', 'active']
    variants: {
        borderStyle: ['responsive', 'hover', 'focus'],
        borderColor: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
        backgroundColor: ['responsive', 'hover', 'focus', 'active', 'group-hover', 'odd', 'even'],
        borderWidth: ['responsive', 'first', 'hover', 'focus'],
    },
}
