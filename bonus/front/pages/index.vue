<template>
  <div class="flex flex-col items-center">

    <TextImage
      imageUrl="/uploads/visuals/cyber.png"
      imageBackgroundUrl="/uploads/visuals/veins.png"
      altText="Description de l'image"
      title="Cyberr."
      description="Enhance Your Human Potential"
    />

    <Banner
      description="Check our Cybernetic Implants"
      button-link="/shop"
      button-text="Shop now"
    />
    <ProductBlock title="Military Collection" collection="military" />
    
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Banner from '~/components/block/HeroBanner.vue';
import ProductBlock from '~/components/block/ProductBlock.vue';
import ImageText from '~/components/block/ImageText.vue';
import TextImage from '~/components/block/TextImage.vue';

const products = ref([]);

onMounted(async () => {
  const response = await fetch("http://localhost:8001/api/products");
  products.value = await response.json();
});

</script>
