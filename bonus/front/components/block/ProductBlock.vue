<template>
  <div class="product-block pl-[10%] pr-[10%] mt-10 mb-10">
    <h2 v-if="title" class="mb-10">_{{ title }}</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      <div v-for="product in filteredProducts" :key="product.id">
        <nuxt-link :to="`/products/${product.id}`">
          <div class="card relative bg-darker rounded-lg overflow-hidden shadow-md h-[400px]" ref="productCard">
            <img :src="`/uploads/products/${product.photo}`" :alt="product.name" class="w-full h-48 object-cover"/>
            <div class="p-4">
              <h3 class="font-bold text-xl line-clamp-2">_{{ product.name }}</h3>
              <p class="mt-2 line-clamp-2">{{ product.description }}</p>
            </div>
            <div class="absolute bottom-0 right-0 p-4 bg-purple text-right font-semibold flex items-center">
              {{ product.price }} 
              <img src="/uploads/visuals/crypto-removebg.png" alt="Credits" class="w-8"> 
            </div>
            <div class="glow" />
          </div>
        </nuxt-link>
      </div>
    </div>
  </div>
</template>

<style scoped>
.card {
  transition-duration: 300ms;
  transition-property: transform, box-shadow;
  transition-timing-function: ease-out;
  transform: rotate3d(0);
}
.card:hover {
  transition-duration: 150ms;
  box-shadow: 0 5px 20px 5px #00000044;
}
.card .glow {
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  background-image: radial-gradient(circle at 50% -20%, #ffffff22, #0000000f);
}
</style>

<script>
import { rotateToMouse } from '~/assets/src/js/product-card.js'

export default {
  props: {
    title: {
      type: String,
      required: true,
    },
    collection: {
      type: String,
      required: false,
      default: null,
    },
    category: {
      type: String,
      required: false,
      default: null,
    },
  },
  data() {
    return {
      products: [],
    };
  },
  async mounted() {
    const response = await fetch(`http://localhost:8001/api/products`);
    const data = await response.json();
    this.products = data;

    this.$nextTick(() => {
      const cards = document.querySelectorAll('.card');

      cards.forEach((card) => {
        rotateToMouse(card);
      });
    });
  },
  computed: {
    filteredProducts() {
      if (this.collection && this.category) {
        return this.products.filter(product => product.collection === this.collection && product.category === this.category);
      } else if (this.collection) {
        return this.products.filter(product => product.collection === this.collection);
      } else if (this.category) {
        return this.products.filter(product => product.category === this.category);
      } else {
        return this.products;
      }
    },
  },
};
</script>

