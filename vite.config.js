import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { readdirSync } from 'node:fs';

function getCssEntries(directory) {
    return readdirSync(directory, { withFileTypes: true })
        .flatMap((entry) => {
            const path = `${directory}/${entry.name}`;

            if (entry.isDirectory()) {
                return getCssEntries(path);
            }

            return path !== 'resources/css/app.css' && path.endsWith('.css') ? [path] : [];
        })
        .sort();
}

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', ...getCssEntries('resources/css')],
            refresh: true,
        }),
    ],
});
