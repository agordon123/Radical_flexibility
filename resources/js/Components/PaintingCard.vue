<!-- resources/js/Components/PaintingCard.vue -->

<template>
  <div class="card">
    <img :src="image_path" :alt="title" class="card-img-top" />
    <div class="card-body">
      <h5 class="card-title">{{ title }}</h5>
      <p class="card-text">{{ description }}</p>
      <p class="card-text">Artist: {{ artist }}</p>
      <p class="card-text">Price: ${{ price }}</p>
      <button class="btn btn-primary" @click="buyPainting">Buy Painting</button>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
  id: Number,
  image_path: String,
  title: String,
  description: String,
  artist: String,
  price: Number,
});

const buyPainting = () => {
  // Implement the logic for buying the painting here.
};
</script>
