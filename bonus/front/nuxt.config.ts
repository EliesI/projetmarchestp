export default defineNuxtConfig({
    modules: ['@nuxtjs/tailwindcss'],
    // Defaults options
    tailwindcss: {
        cssPath: '~/assets/src/css/tailwind.css',
        configPath: 'tailwind.config',
        exposeConfig: false,
        exposeLevel: 2,
        injectPosition: 'first',
        viewer: true,
      }
})

  