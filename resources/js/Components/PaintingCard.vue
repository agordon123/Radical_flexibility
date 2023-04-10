<!-- resources/js/Components/PaintingCard.vue -->



<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed, defineAsyncComponent, ref } from "vue";
defineAsyncComponent('Painting',{
    props: props,
    painting: Object ,

});

const paintings = computed(() => usePage().props.paintings);

const props = defineProps(['painting']);
const buyPainting = () => {
    // Implement the logic for buying the painting here.
};
</script>
