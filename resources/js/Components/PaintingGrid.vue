<template>
    <div class="grid grid-cols-3 gap-4">
        <PaintingCard
            v-for="(painting, index) in paintings"
            :key="index"
            :painting="painting"
        />
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { defineComponent } from "vue";
import PaintingCard from "./PictureCard.vue";

defineComponent({
    name: "PaintingGrid",
    components: {
        PaintingCard,
    },
    props: {
        paintings: {
            type: Array,
            required: true,
            path: String,
        },
    },
});
const imagePaths = ref([]);

const fetchImagePaths = async () => {
    // Fetch image paths from the server and assign to 'imagePaths' ref
    // Replace the URL with your server's API endpoint
    const response = await fetch("/paintings");
    imagePaths.value = await response.json();
};

onMounted(() => {
    fetchImagePaths();
});
</script>
