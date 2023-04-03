<template>
    <Layout>
        <div
            class="grid grid-cols-3 gap-4 mx-auto"
            v-for="painting in paintings"
            :key="painting.id"
        >
            <PaintingCard :paintings="paintings"> </PaintingCard>
        </div>
    </Layout>
</template>

<script setup>
import PaintingCard from "@/Components/PaintingCard.vue";
import Layout from "@/Layouts/Layout.vue";
import { usePage, Head } from "@inertiajs/vue3";
import { defineComponent } from "vue";
import { ref } from "vue";

const paintings = usePage().props.paintings;
defineComponent({
    name: "HomePage",
    title: ref("Welcome to the Home Page"),
    layout: Layout,
});
defineProps({
    paintings: Array,
});
const title = ref("Radical Flexibility");
</script>
