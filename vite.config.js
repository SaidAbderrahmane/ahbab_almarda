import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/dark-mode.js',
                'resources/js/charts.js',
                'resources/js/compaigns.js',
                'resources/js/compaign-details.js',
                'resources/js/donors.js',
                'resources/js/locations.js',
                'resources/js/profile.js',
                'resources/js/users.js',
                'resources/js/aghermes.js',
            ],
            refresh: true,
        }),
    {
            name: 'blade',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: '*',
                    });
                }
            },
        },
    ],
    
    
});
