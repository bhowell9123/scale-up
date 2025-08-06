import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
  plugins: [],
  root: path.resolve(__dirname, 'resources'),
  base: process.env.NODE_ENV === 'development'
    ? '/'
    : '/app/themes/sage/',
  build: {
    outDir: path.resolve(__dirname, 'public'),
    emptyOutDir: true,
    manifest: true,
    target: 'es2018',
    rollupOptions: {
      input: {
        app: path.resolve(__dirname, 'resources/scripts/app.js'),
      },
      output: {
        entryFileNames: 'scripts/[name].js',
        chunkFileNames: 'scripts/[name].js',
        assetFileNames: (assetInfo) => {
          if (assetInfo.name.match(/\.(css)$/)) {
            return 'styles/[name][extname]';
          }
          return 'assets/[name][extname]';
        },
      },
    },
  },
  server: {
    host: '0.0.0.0',
    port: 3000,
    strictPort: true,
    https: false,
    hmr: {
      host: 'localhost',
    },
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources'),
    },
  },
});