const colors = require('tailwindcss/colors')

module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue'
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    colors: {
      gray: colors.gray
    },
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
