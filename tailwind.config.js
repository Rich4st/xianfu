/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ['./**/*.php', './**/*.js'],
  theme: {
    extend: {
      backgroundColor: {
        'dark': '#0c0c0c !important',
        'dark-card': '#121212 !important',
      }
    },
  },
  plugins: [
    require('@tailwindcss/typography')
  ],
}

