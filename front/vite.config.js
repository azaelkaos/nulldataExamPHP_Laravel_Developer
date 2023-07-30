import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import lsLintPlugin from 'vite-plugin-ls-lint'
// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(
      {
        defineModel:true
      }
    ),
	lsLintPlugin(),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  }
})
