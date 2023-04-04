<!-- resources/js/Components/PaintingCard.vue -->

<template>
    <div
        v-for="painting in paintings"
        :key="painting.id"
        class="w-full max-w-sm lg:max-w-[80%] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 items-center justify-center"
    >
        <TheCard
            variant="image"
            :img-src="`${painting.filename}`"
            ref="paintingContainer"
            :img-alt="`${painting.name}`"
        >
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
