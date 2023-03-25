<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Head } from "@inertiajs/vue3";
defineProps({
    name: "Dashboard",
    title: "Dashboard",
    layout: Layout,
});
</script>

<template>
    <Head title="Dashboard" />

    <Layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
    </Layout>
</template>
