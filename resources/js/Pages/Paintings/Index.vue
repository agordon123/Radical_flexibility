<template>
    <div class="container">
      <div class="row">
        <div class="col-md-4" v-for="painting in paintings" :key="painting.id">
          <PaintingCard v-bind="painting" />
        </div>
      </div>
    </div>
  </template>
  
  <script setup lang="js">
  import PaintingCard from "@/Components/PaintingCard.vue";
  
  const props = defineProps({
    paintings: Array,
  });
  </script>
  