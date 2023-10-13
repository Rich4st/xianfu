/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ['./**/*.php', './**/*.js'],
  theme: {
    extend: {
      backgroundColor: {
        'dark': '#0c0c0c',
        'dark-card': '#121212',
        'primary': '#570df8',
        'secondary': '#f000b8',
        'accent': '#1dcdbc',
        'info': '#3abff8',
        'success': '#36d399',
        'error': '#f87272'
      }
    },
  },
  plugins: [
  ],
}
