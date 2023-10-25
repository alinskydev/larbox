import { fileURLToPath, URL } from 'url';
import fs from 'fs/promises';

import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [
        vue(),
        {
            name: 'build-html',
            apply: 'build',
            transformIndexHtml: {
                enforce: 'pre',
                async transform() {
                    let html = await fs.readFile('./index.html', 'utf8');
                    return html.replaceAll('<script src=', '<script type="module" src=');
                },
            },
        },
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./src', import.meta.url)),
        },
    },
    build: {
        assetsDir: 'particles',
    },
});
