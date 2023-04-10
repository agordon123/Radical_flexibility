<template>
    <div class="grid grid-cols-3 gap-4">
   <PaintingCard />
    </div>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import { defineComponent ,computed} from "vue";
import PaintingCard from "./PaintingCard.vue";
defineProps({
    components:{
        PaintingCard
    }
})
defineComponent({
    name: "PaintingGrid",
    attrs:{

    },
    props: {
        paintings:computed(() => usePage().props.paintings),
        required: false,
    },
})
</script>
