import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        origin: 'https://pp-app-6wie9.ondigitalocean.app',
    },
    build: {
        manifest: true,
        outDir: 'public/build',
    },
});
