/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ['./**/*.php', './**/*.js'],
  theme: {
    extend: {
      backgroundColor: {
        'dark': '#0c0c0c',
        'dark-card': '#121212',
      }
    },
  },
  plugins: [
    function ({ addUtilities }) {
      const newUtilities = {
        '.xf-container': {
          'max-width': '80rem',
          'margin': '0 auto',
          'padding': '0 0.5rem',
          // media query
          '@screen sm': {
            'padding': '0 0',
          },
        },
      }

      addUtilities(newUtilities, ['responsive', 'hover'])
    }
  ],
}
