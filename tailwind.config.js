/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        'food-primary': '#FF385C',
        'food-secondary': '#2D2D2D',
        'food-bg': '#FFFFFF',
        'food-surface': '#F5F5F5',
        'food-outline': '#CCCCCC',
      },
      fontFamily: {
        'vazir': ['Vazir', 'sans-serif'],
      }
    },
  },
  plugins: [],
}