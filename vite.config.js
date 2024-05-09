import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/views/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            external: ['bootstrap'], // Add bootstrap to external
        },
    },
});
