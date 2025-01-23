import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            buildDirectory: 'build', // Ensures assets are built into the correct directory
        }),
    ],
    build: {
        manifest: true, // Ensures the manifest file is generated
        outDir: 'public/build', // Outputs directly to public/build/
        rollupOptions: {
            output: {
                entryFileNames: 'app.js',
                chunkFileNames: '[name].js',
                assetFileNames: '[name].[ext]',
            },
        },
    },
});