<template>
    <div class="flex flex-col items-center mt-10">
        <h1 class="mb-10">Categories</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-10 ml-[5%] mr-[5%]">
            <ImageCard
                title="sensory"
                imgUrl="/uploads/visuals/sensory.png"
                link="/Category/sensory"
            />
            <ImageCard
                title="physical"
                imgUrl="/uploads/visuals/physical.png"
                link="/Category/physical"
            />
            <ImageCard
                title="health"
                imgUrl="/uploads/visuals/health.png"
                link="/Category/health"
            />
            <ImageCard
                title="mental"
                imgUrl="/uploads/visuals/mental.png"
                link="/Category/mental"
            />
            <ImageCard
                title="implant accessory"
                imgUrl="/uploads/visuals/implant accessory.png"
                link="/Category/implant accessory"
            />
        </div>
    </div>
</template>
  
<script setup>
import ImageCard from '~/components/block/ImageCard.vue';
</script>