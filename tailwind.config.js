/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Poppins", "sans-serif"],
            },
            fontSize: {
                xs2: "8px",
                xs1: "10px",
                xs: "12px",
                sm: "14px",
                base: "16px",
                md: "18px",
                md2: "28px",
                lg: "36px",
                xl: "38px",
                xl2: "48px",
            },
            backgroundColor:{
                bluePrimary: "#066AD8"
            }
        },
    },
    plugins: [],
};
