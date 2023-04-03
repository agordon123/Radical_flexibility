<template>
    <div class="grid grid-cols-3 gap-4">
        <PaintingCard
            v-for="(painting, index) in $page.props.paintings"
            :key="index"
            :painting="painting"
        />
    </div>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import { defineComponent } from "vue";
import PaintingCard from "./PaintingCard.vue";
const page = usePage();

defineComponent({
    name: "PaintingGrid",
    props: {
        painting: Object,
        required: false,
    },
});
</script>
