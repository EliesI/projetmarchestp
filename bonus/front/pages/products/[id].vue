<template>
    <div class="flex flex-col items-center mt-10 pl-5 pr-5">
      <ProductPage v-if="product" :product="product" />    
    </div>
</template>
  
<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import ProductPage from '~/components/block/ProductPage.vue';

const route = useRoute();
const product = ref({});

const fetchProduct = async (id) => {
  const response = await fetch(`http://localhost:8001/api/products/${id}?populate=*`);
  if (response.ok) {
    const data = await response.json();
    product.value = data[0];
  } else {
    console.error('Failed to fetch product data');
  }
};

onMounted(async () => {
  console.log('Route params:', route.params);
  await fetchProduct(route.params.id);
});
</script>

