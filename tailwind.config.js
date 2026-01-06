/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'uitm-blue': '#012E6F',
        'uitm-violet': '#753895',
        'uitm-gold': '#FFD700',
      },
    },
  },
  plugins: [],
}