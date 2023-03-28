<template>

</template>

<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps({
    paintings: { type: Array, required: true },
});

const page = usePage();

const formatPrice = computed((price) => {
    return `$${(price / 100).toFixed(2)}`;
});

const isActive = computed(() => {
    return (
        page.url.route("paintings.show") &&
        page.props.painting.id === props.painting.id
    );
});
</script>
