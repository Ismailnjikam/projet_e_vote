import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/global.css',
                'resources/css/welcome.css',
                'resources/css/dashboard.css',
                'resources/css/auth/login.css',
                'resources/css/auth/register.css',
                'resources/css/admin/dashboard.css',
                'resources/js/app.js',
                'resources/js/admin/dashboard.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
