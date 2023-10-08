/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ['./**/*.php', './**/*.js'],
  theme: {
    extend: {
    },
  },
  plugins: [
    function ({ addUtilities }) {
      const newUtilities = {
        '.flex-center': {
          display: 'flex',
          'justify-content': 'center',
          'align-items': 'center',
        },
        '.flex-col-center': {
          display: 'flex',
          'flex-direction': 'column',
          'justify-content': 'center',
          'align-items': 'center',
        },
        '.link': {
          color: '#007bff',
          'text-decoration': 'none',
        },
        '.link:hover': {
          color: '#0056b3',
          'text-decoration': 'underline',
        },
        '.link:visited': {
          color: '#007bff',
        },
        '.link:active': {
          color: '#0056b3',
        },
        '.bg-dark': {
          'background-color': '#181818',
        },
      }

      addUtilities(newUtilities, ['responsive', 'hover'])
    }
  ],
}
