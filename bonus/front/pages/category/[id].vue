<template>
  <div class="flex flex-col items-center mt-10 pl-5 pr-5">
    <div class="w-[700px]">
    <TextImage
      :imageUrl="`/uploads/visuals/${collectionName}.png`"
      altText="alt"
      :title="`_${collectionName}`"
    />
    </div>

    <ProductBlock title="Category" :category="collectionName" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import ProductBlock from '~/components/block/ProductBlock.vue';
import TextImage from '~/components/block/TextImage.vue';

const route = useRoute();
const product = ref({});
const collectionName = ref("");

const fetchProduct = async (id) => {
  const response = await fetch(`http://localhost:8001/api/products/`);
  if (response.ok) {
    const data = await response.json();
    product.value = data[0];
  } else {
    console.error('Failed to fetch product data');
  }
};

const pathParts = route.path.split('/');
collectionName.value = pathParts[pathParts.length - 1];

onMounted(async () => {
  await fetchProduct(route.params.id);
});
</script>
