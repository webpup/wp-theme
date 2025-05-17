import { defineConfig, loadEnv } from 'vite'
import path from "path";
import tailwindcss from '@tailwindcss/vite'
export default defineConfig(({ command, mode }) => {
    const env = loadEnv(mode, process.cwd());
    return {

        root: path.resolve(__dirname, "src"),
        base: "/",
        server: {
            host: env.VITE_APP_URL || "localhost",
            port: env.VITE_PORT || 5173,
            cors: true,
            headers: {
                "Access-Control-Allow-Origin": "*", // ✅ allow WordPress to request assets
            },
        },
        plugins: [
            tailwindcss(),
        ],
        build: {
            outDir: "../dist",
            emptyOutDir: true,
            rollupOptions: {
                input: {
                    main: "src/js/main.js",
                },
                output: {
                    entryFileNames: "js/[name].js",
                    assetFileNames: "css/[name].[ext]",
                },
            },
        },
    }
});