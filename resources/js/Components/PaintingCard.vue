<!-- resources/js/Components/PaintingCard.vue -->
<template>

</template>


<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed, defineAsyncComponent, ref } from "vue";
defineAsyncComponent({
    props: props,
    painting: Object ,

});



const props = defineProps(['painting']);
const buyPainting = () => {
    // Implement the logic for buying the painting here.
};
</script>
