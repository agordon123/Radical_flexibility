<template>
<the-card variant="image" img-src="`${paintings}`" img-alt="Desk">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
    <p class="font-normal text-gray-700 dark:text-gray-400">
      Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.
    </p>
  </the-card>
</template>

<script setup>
import { computed, onMounted } from "vue";

import { defineProps } from "vue";
import {TheCard} from 'flowbite-vue'
import { initFlowbite } from "flowbite";
defineProps({
    painting: { type: Object  },
});

onMounted(()=>initFlowbite())



const isActive = computed(() => {
    return (
        page.url.route("paintings.show") &&
        page.props.painting.id === props.painting.id
    );
});
</script>
