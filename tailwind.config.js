/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.ts",
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      fontFamily: {
        'sans': ['Roboto', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
