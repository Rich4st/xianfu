/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ['./**/*.php', './**/*.js'],
  theme: {
    extend: {
      colors: {
        'dark': '#0c0c0c !important',
        'dark-card': '#121212 !important',
        'primary': '#8054b3',
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography')
  ],
}

