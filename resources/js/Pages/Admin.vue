<template>
    <LayoutVue>
        <div v-if="!user"></div>
    </LayoutVue>
</template>
<script setup>
import LayoutVue from "@/Layouts/Layout.vue";
const user = ref(null);
</script>
