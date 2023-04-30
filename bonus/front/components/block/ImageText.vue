<template>
    <div class="text-image flex flex-col md:flex-row items-start">
        <img :src="imageUrl" :alt="altText" class="w-[400px] md:mr-10">
        <div class="text-image__text mt-2 max-w-[700px]">
            <h2 class="text-image__title">{{ title }}</h2>
            <p class="text-image__description">{{ description }}</p>
        </div>
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
    padding: 2rem;
}
.text-image__text {
    width: 100%;
    text-align: left;
}

.text-image__title {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.text-image__description {
    font-size: 1.2rem;
}
</style>