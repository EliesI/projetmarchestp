<template>
  <Header />
    <NuxtPage />
  <Footer />
</template>

<script setup>
import '@/assets/src/css/tailwind.css'
import { ref, provide } from 'vue';

const cart = ref([]);
provide('cart', cart);
</script>