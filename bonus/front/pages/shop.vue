<template>
    <div class="flex flex-col items-center mt-10 pl-5 pr-5">
        <h1 class="mb-10">Shop</h1>
        <ProductBlock title="All products"/>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from "vue";
  import ProductBlock from '~/components/block/ProductBlock.vue';
  
  const products = ref([]);
  
  onMounted(async () => {
    const response = await fetch("http://localhost:8001/api/products");
    products.value = await response.json();
  });
  </script>
  
  