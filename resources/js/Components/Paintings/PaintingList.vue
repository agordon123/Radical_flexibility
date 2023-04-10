<template>
    <div class="paintings-container grid grid-cols-3 gap-4 justify-center">
      <div v-for="painting in paintings" :key="painting.id" class="painting-card bg-white rounded-lg shadow-md overflow-hidden">
        <img :src="painting.filename" alt="Painting" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="text-xl font-medium text-gray-800">{{ painting.title }}</h3>
          <p class="text-gray-600">{{ painting.artist }}</p>
        </div>
      </div>
    </div>
  </template>

<script setup lang="js">
import { defineComponent,computed } from "vue"

const paintings = computed(()=>usePage().props.paintings = paintings.value)
  defineComponent( {
    name: 'PaintingList',
    props: {
      paintings: {
        type: Array,
        required: true,
      },
    },
  })
  </script>

  <style>
  .paintings-container {
    /* This creates a 3-column grid layout */
    /* The `grid-cols-3` class creates 3 columns */
    /* The `gap-4` class adds a 4px gap between each column */
    display: grid;
  }

  .painting-card {
    /* This styles each individual card */
    /* The `bg-white` class sets the background color to white */
    /* The `rounded-lg` class rounds the corners */
    /* The `shadow-md` class adds a subtle drop shadow */
    /* The `overflow-hidden` class hides any content that goes beyond the card boundaries */
    width: 100%;
    max-width: 24rem;
  }
  </style>
