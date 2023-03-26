<template>
    <Head title="Radical Flexibility"></Head>
    <Layout>
        <template #default
            ><div>
                <span> {{ title }}</span>
            </div></template
        >
    </Layout>
</template>

<script setup>
import Layout from "@/Layouts/Layout.vue";
import { usePage, Head } from "@inertiajs/vue3";
import { defineComponent } from "vue";
import { ref } from "vue";


usePage("HomePage");
defineComponent({
    name: "HomePage",
    title: ref("Welcome to the Home Page"),
});
const title = ref("Radical Flexibility");
</script>
