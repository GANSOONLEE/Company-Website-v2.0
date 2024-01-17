/** @type {import('tailwindcss').Config} */

module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    "./node_modules/flowbite/**/*.js",
    './resources/js/**/*.jsx',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      aria: {
        current: 'current'
      },
      animation: {
        'concentric-circles-normal': 'concentric-circles 2s linear infinite alternate-reverse',
      },
      keyframes: {
        'concentric-circles': {
          '0%, 100%': { transform: 'opacity(1)' },
          '50%': { transform: 'opacity(0)' },
        }
      }
    },
    colors: {
      'theme-1': '#EB0A1E',
      primary: { "50": "#eff6ff", "100": "#dbeafe", "200": "#bfdbfe", "300": "#93c5fd", "400": "#60a5fa", "500": "#3b82f6", "600": "#2563eb", "700": "#1d4ed8", "800": "#1e40af", "900": "#1e3a8a", "950": "#172554" },
      'footer-cyan': "#00e5ff",
      'footer-gold': "#ffd800",
      'footer-thinker': "#00ffa1",
      'footer-green': "#38ff09",
      'footer-blue': "#00c0ff",
    },
    zIndex: {
      999999: '999999',
      99999: '99999',
      9999: '9999',
      999: '999',
      99: '99',
      9: '9',
      1: '1',
    },
    spacing: {
      4.5: '1.125rem',
      5.5: '1.375rem',
      6: '1.5rem',
      6.5: '1.625rem',
      7.5: '1.875rem',
      8: "2rem",
      8.5: '2.125rem',
      9: '2.25rem',
      9.5: '2.375rem',
      10: '2.5rem',
      10.5: '2.625rem',
      11: '2.75rem',
      11.5: '2.875rem',
      12: '3rem',
      12.5: '3.125rem',
      13: '3.25rem',
      13.5: '3.375rem',
      14: '3.5rem',
      14.5: '3.625rem',
      15: '3.75rem',
      15.5: '3.875rem',
      16: '4rem',
      16.5: '4.125rem',
      17: '4.25rem',
      17.5: '4.375rem',
      18: '4.5rem',
      18.5: '4.625rem',
      19: '4.75rem',
      19.5: '4.875rem',
      21: '5.25rem',
      21.5: '5.375rem',
      22: '5.5rem',
      22.5: '5.625rem',
      24.5: '6.125rem',
      25: '6.25rem',
      25.5: '6.375rem',
      26: '6.5rem',
      27: '6.75rem',
      27.5: '6.875rem',
      29: '7.25rem',
      29.5: '7.375rem',
      30: '7.5rem',
      31: '7.75rem',
      32.5: '8.125rem',
      34: '8.5rem',
      34.5: '8.625rem',
      35: '8.75rem',
      36.5: '9.125rem',
      37.5: '9.375rem',
      39: '9.75rem',
      39.5: '9.875rem',
      40: '10rem',
      42.5: '10.625rem',
      44: '11rem',
      45: '11.25rem',
      46: '11.5rem',
      47.5: '11.875rem',
      49: '12.25rem',
      50: '12.5rem',
      52: '13rem',
      52.5: '13.125rem',
      54: '13.5rem',
      54.5: '13.625rem',
      55: '13.75rem',
      55.5: '13.875rem',
      59: '14.75rem',
      60: '15rem',
      62.5: '15.625rem',
      65: '16.25rem',
      67: '16.75rem',
      67.5: '16.875rem',
      70: '17.5rem',
      72.5: '18.125rem',
      73: '18.25rem',
      75: '18.75rem',
      90: '22.5rem',
      94: '23.5rem',
      95: '23.75rem',
      100: '25rem',
      115: '28.75rem',
      125: '31.25rem',
      132.5: '33.125rem',
      150: '37.5rem',
      171.5: '42.875rem',
      180: '45rem',
      187.5: '46.875rem',
      203: '50.75rem',
      230: '57.5rem',
      242.5: '60.625rem',
    },
    maxWidth: {
      2.5: '0.625rem',
      3: '0.75rem',
      4: '1rem',
      11: '2.75rem',
      13: '3.25rem',
      14: '3.5rem',
      15: '3.75rem',
      22.5: '5.625rem',
      25: '6.25rem',
      30: '7.5rem',
      34: '8.5rem',
      35: '8.75rem',
      40: '10rem',
      42.5: '10.625rem',
      44: '11rem',
      45: '11.25rem',
      60: '15rem',
      64: '16rem',
      70: '17.5rem',
      90: '22.5rem',
      94: '23.5rem',
      100: '25rem',
      125: '31.25rem',
      132.5: '33.125rem',
      142.5: '35.625rem',
      150: '37.5rem',
      180: '45rem',
      203: '50.75rem',
      230: '57.5rem',
      242.5: '60.625rem',
      270: '67.5rem',
      280: '70rem',
      292.5: '73.125rem',
    }
  },
  plugins: [
    require('flowbite/plugin'),
    require('@themesberg/flowbite/plugin')
  ],
}