<template>
    <div v-for="painting in paintings" :key="painting.id">
        <img :src="painting.image_url" alt="Painting" />
        <h3>{{ painting.name }}</h3>
        <p>{{ painting.description }}</p>
        <p>{{painting.price}}</p>
        <button @click="addToCart(product)">Add to Cart</button>
    </div>
</template>
<script setup>

</script>
