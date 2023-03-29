<template>
    <div>
        <Layout>
            <template #default>
                <div>
                    <span> {{ $page.props.title }}</span>
                </div>
            </template>
        </Layout>
    </div>
</template>

<script setup>
import Layout from "@/Layouts/Layout.vue";
import { usePage, Head } from "@inertiajs/vue3";
import { defineComponent } from "vue";
import { ref } from "vue";

const homePage = usePage();
defineComponent({
    name: "HomePage",
    title: ref("Welcome to the Home Page"),
});
const title = ref("Radical Flexibility");
</script>
