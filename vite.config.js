import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'node_modules/flatpickr/dist/flatpickr.min.css',
                'node_modules/flatpickr/dist/flatpickr.min.js',
                'node_modules/choices.js/public/assets/styles/choices.min.css',
                'node_modules/choices.js/public/assets/scripts/choices.min.js',
            ],
            refresh: true,
        }),
    ],
});
