<template>
    <div class="flex flex-col items-center mt-10">
        <h1 class="mb-10">Collections</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-10 ml-[5%] mr-[5%]">
            <ImageCard
                title="military"
                imgUrl="/uploads/visuals/military.png"
                link="/Collection/military"
            />
            <ImageCard
                title="scientist"
                imgUrl="/uploads/visuals/scientist.png"
                link="/Collection/scientist"
            />
            <ImageCard
                title="powerfull"
                imgUrl="/uploads/visuals/powerfull.png"
                link="/Collection/powerfull"
            />
            <ImageCard
                title="espionage"
                imgUrl="/uploads/visuals/espionage.png"
                link="/Collection/espionage"
            />
            <ImageCard
                title="premium pack"
                imgUrl="/uploads/visuals/premium pack.png"
                link="/Collection/premium pack"
            />
        </div>
    </div>
</template>
  
<script setup>
import ImageCard from '~/components/block/ImageCard.vue';
</script>