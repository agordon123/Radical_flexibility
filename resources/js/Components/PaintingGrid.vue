<template>
  <div class="grid grid-cols-3 gap-4">
    <PaintingCard v-for="(painting, index) in paintings" :key="index" :painting="painting" />
  </div>
</template>

<script setup>
import { defineComponent } from 'vue';
import PaintingCard from './PictureCard.vue';

 defineComponent({
  name: 'PaintingGrid',
  components: {
    PaintingCard,
  },
  props: {
    paintings: {
      type: Array,
      required: true,
    },
  },
});
</script>

