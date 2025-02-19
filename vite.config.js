import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/script.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '127.0.0.1', // Paksa menggunakan IPv4
    },
});
