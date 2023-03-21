<template>
  <div class="card">
    <img :src="painting.image_url" class="card-img-top" :alt="painting.title">
    <div class="card-body">
      <h5 class="card-title">{{ painting.title }}</h5>
      <p class="card-text">{{ painting.description }}</p>
      <p class="card-text">{{ formatPrice(painting.price) }}</p>
      <inertia-link :href="route('paintings.show', { id: painting.id })" :class="{ 'btn btn-primary': isActive }">
        View Painting
      </inertia-link>
    </div>
  </div>
</template>

<script>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

export default {
  name: 'PaintingCard',
  props: {
    painting: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const page = usePage();

    const formatPrice = (price) => {
      return `$${(price / 100).toFixed(2)}`;
    };

    const isActive = computed(() => {
      return page.url.route('paintings.show') && page.props.painting.id === props.painting.id;
    });

    return {
      formatPrice,
      isActive,
    };
  },
};
</script>
