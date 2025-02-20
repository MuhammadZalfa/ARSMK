import defaultTheme from "tailwindcss/defaultTheme";
/** @type {import('tailwindcss').Config} */
// tailwind.config.js
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    safelist: [
        "hover-pill", // Tambahkan kelas custom ini agar tidak di-purge
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};
