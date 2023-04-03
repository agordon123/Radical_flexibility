<!-- resources/js/Components/PaintingCard.vue -->

<template>
    <div v-for="painting in paintings" :key="painting.id">
        <TheCard :img-src="`${painting.filename}`" ref="paintingContainer">
            <div class="card-body">
                <h5 class="card-title">{{ painting.title }}</h5>
                <p class="card-text">{{ painting.description }}</p>
                <p class="card-text">Artist: {{ painting.name }}</p>
                <p class="card-text">Price: ${{ painting.price }}</p>
                <button class="btn btn-primary" @click="buyPainting">
                    Buy Painting
                </button>
            </div>
        </TheCard>
    </div>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import { TheCard } from "flowbite-vue";
import { computed, defineComponent, ref } from "vue";
defineComponent({
    name: "PaintingCard",
    props: props,
    painting: Object || null,
});
const paintingContainer = ref(null);
const paintings = computed(() => usePage().props.paintings);
const props = defineProps({
    painting: {
        id: Number,
        filename: String,
        name: String,
        description: String,
        artist: String,
        price: Number,
        status: Boolean,
        created_at: Date,
        updated_at: Date,
    },
});

const buyPainting = () => {
    // Implement the logic for buying the painting here.
};
</script>
