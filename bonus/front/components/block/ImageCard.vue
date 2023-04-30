<template>
    <nuxt-link :to="link">
        <div class="card relative rounded-lg overflow-hidden">
            <img :src="imgUrl" :alt="title" class="w-full object-cover" />
            <h3 class="font-bold text-xl line-clamp-2">_{{ title }}</h3>
            <div class="glow" />
        </div>
    </nuxt-link>
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
    name: "ImageCard",
    props: {
        title: {
            type: String,
            required: true,
        },
        imgUrl: {
            type: String,
            required: false,
        },
        link: {
            type: String,
            required: false,
        },
    },
    async mounted() {
    this.$nextTick(() => {
      const cards = document.querySelectorAll('.card');

      cards.forEach((card) => {
        rotateToMouse(card);
      });
    });
  },
};
</script>
  
  