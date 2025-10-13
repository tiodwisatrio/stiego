import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js", // Tambahkan kalau ada Alpine/JS yang bikin class dinamis
    ],

    safelist: [
        // Slider dots
        "bg-[#B62127]",
        "bg-gray-400",

        // Tombol navigasi
        "p-1",
        "p-2",
        "sm:p-2",
        "w-2",
        "w-3",
        "h-2",
        "h-3",

        // Background opacity / hover
        "bg-black/30",
        "hover:bg-black/50",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#B62127", // Bisa dipakai di slider misal bg-primary
            },
        },
    },

    plugins: [forms],
};
