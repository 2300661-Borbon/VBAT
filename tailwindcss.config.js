/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./resources/**/*.blade.php", // If using Laravel
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./resources/**/*.css",
  ],
  theme: {
    extend: {
      colors: {
        // You can define your custom Navy and Blue here for easier use
        'brand-navy': '#001f3f',
        'brand-blue': '#00416a',
      },
    },
  },
  plugins: [],
}