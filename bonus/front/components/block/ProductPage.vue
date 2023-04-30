<template>
    <div class="text-image flex flex-col md:flex-row items-start mb-10">
        <img :src="`/uploads/products/${product.photo}`" :alt="altText" class="w-[400px] md:mr-10">
        <div class="text-image__text mt-2 max-w-[700px]">
            <h2 class="text-image__title">{{ product.name }}</h2>
            <p class="text-image__description">{{ product.description }}</p>
            <div class="product-quantity">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" min="1" v-model="quantity" class="w-20 ml-2" />
            </div>
            <button @click="addToCart">Add to Cart</button>
        </div>
    </div>
</template>

<script>
import { ref, inject } from 'vue';

export default {
    name: 'ProductPage',
    props: {
        product: {
            type: Object,
            required: true,
        },
    },
    setup(props) {
        const cart = inject('cart');
        const quantity = ref(1);

        const addToCart = async () => {
            const itemInCart = cart.value.find((item) => item.product.id === props.product.id);

            if (itemInCart) {
                itemInCart.quantity += quantity.value;
            } else {
                cart.value.push({ product: props.product, quantity: quantity.value });
            }

            const routeUrl = `http://localhost:8001/api/cart/add/${props.product.id}`;

            try {
                const token = localStorage.getItem('token');
                const response = await fetch(routeUrl, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ quantity: quantity.value }),
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                console.log('Item added to cart');
            } catch (error) {
                console.error('Error adding item to cart:', error);
            }
        };

        const altText = props.product.name || 'Product Image';

        return { altText, quantity, addToCart };
    },
};
</script>

<style scoped>
input[type="number"] {
    background-color: rgba(0, 0, 0, 0);
    border: 1px solid black;
}
</style>
