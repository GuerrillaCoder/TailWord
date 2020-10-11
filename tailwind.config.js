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
  theme: {},
  // variants: ['responsive', 'group-hover', 'disabled', 'hover', 'focus', 'active']
  variants: {
    borderStyle: ['responsive', 'hover', 'focus'],
    borderColor: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    backgroundColor: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    borderWidth: ['responsive', 'first', 'hover', 'focus'],
  },
}
