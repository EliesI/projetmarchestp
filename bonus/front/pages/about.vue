<template>
    <div class="flex flex-col items-center mt-10">
        <ImageText imageUrl="/uploads/visuals/logo-removebg.png" altText="Description de l'image" title="About Cyberr." />
        <HighlightedSection>
            <p>
                At Cyberr., your safety and satisfaction are our top priorities.
                We meticulously test and refine all our products to ensure they meet the
                highest quality standards. Furthermore, our team of experienced technicians
                is always available to guide you through the implantation process and
                provide personalized support to ensure optimal compatibility and seamless
                integration with your unique physiology.
            </p>
            <p>For those seeking a competitive edge in their professional lives, our Military, Scientist, and Espionage
                Collections feature powerful and specialized cybernetic enhancements that cater to various fields and
                professions. Additionally, our exclusive Premium Pack offers a curated selection of the most advanced and
                sought-after implants, taking your cybernetic experience to unprecedented heights.</p>
            <p>Embrace the future with confidence and unlock your true potential with Cybertech Emporium's groundbreaking
                cybernetic implants. Join us on this thrilling journey into a world of endless possibilities, where the line
                between human and machine dissolves, and a new era of cyberpunk-enhanced living awaits.</p>
        </HighlightedSection>

        <Banner description="Check our Cybernetic Implants" button-link="/shop" button-text="Shop now" />

    </div>
</template>

<script setup>
import ImageText from '~/components/block/ImageText.vue';
import HighlightedSection from '~/components/block/HighlightedSection.vue';
import Banner from '~/components/block/HeroBanner.vue'
</script>