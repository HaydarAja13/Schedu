import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: ["resources/views/**/*.blade.php"],
        }),
        tailwindcss(),
    ],
});
