<template>
    <div class="grid grid-cols-3 gap-4 mx-auto">
       <PaintingCard v-for="(painting, idx) in paintings" :paintings="paintings" :key="idx">
    </PaintingCard>
                <div>
                    <span> {{ $page.props.title }}</span>
                </div>

    </div>
</template>

<script setup>
import PaintingCard from "@/Components/Paintings/PaintingCard.vue";
import Layout from "@/Layouts/Layout.vue";
import { usePage, Head } from "@inertiajs/vue3";
import { defineComponent } from "vue";
import { ref } from "vue";

const {props} = usePage();
defineComponent({
    name: "HomePage",
    title: ref("Welcome to the Home Page"),

});
defineProps({
    paintings:props.paintings
})
const title = ref("Radical Flexibility");
</script>
