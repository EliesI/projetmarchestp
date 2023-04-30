<template>
    <div class="text-image flex flex-col md:flex-row items-start">
        <img v-if="imageBackgroundUrl" :src="imageBackgroundUrl" :alt="altText" class="w-full z-0 hidden md:block">
        <div class="text-image__text mt-2 ml-10 z-10 absolute">
            <h2 class="text-image__title text-6xl md:text-7xl xl:text-9xl">{{ title }}</h2>
            <p class="text-image__description">{{ description }}</p>
        </div>
        <img :src="imageUrl" :alt="altText" class="w-full md:ml-10">
    </div>
</template>

<script>
export default {
    name: "TextImage",
    props: {
        imageUrl: {
            type: String,
            required: true,
        },
        imageBackgroundUrl: {
            type: String,
            required: true,
        },
        altText: {
            type: String,
            required: true,
        },
        title: {
            type: String,
            required: true,
        },
        description: {
            type: String,
            required: true,
        },
    },
};
</script>

<style scoped>
.text-image {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.text-image__text {
    text-align: left;
}

.text-image__title {
    margin-bottom: 1rem;
    max-width: 400px;
}

.text-image__description {
    font-size: 1.2rem;
}

@media (max-width: 767px) {
  .text-image__text {
    position: absolute;
    bottom: 450px;
    left: 20px;
  }
}

</style>