<template>
    <div v-for="product in products" :key="product.id">
        <img :src="product.image" alt="Product Image" />
        <h3>{{ product.name }}</h3>
        <p>{{ product.description }}</p>
        <button @click="addToCart(product)">Add to Cart</button>
    </div>
</template>
<script setup>

</script>
