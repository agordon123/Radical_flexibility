<template>
    <Head :title="title" />
    <Layout>
        <template #default>
            <div
                class="grid grid-cols-3 max-w-[80%] col-auto mx-auto 2xl:grid grid-flow-row items-center"
                v-if="paintings"
            >
                <template v-for="painting in paintings" :key="painting.id">
                    <PaintingCard :painting="painting" />
                    <PaintingSkeleton v-show="!paintings"> </PaintingSkeleton>
                </template>
            </div>
        </template>
    </Layout>
</template>

<script setup>
import Layout from "@/Layouts/Layout.vue";
import PaintingCard from "@/Components/PaintingCard.vue";
import { usePage, Head } from "@inertiajs/vue3";
import { defineComponent, onMounted, reactive } from "vue";
import { ref, provide, computed } from "vue";
import PaintingSkeleton from "@/Components/Paintings/PaintingSkeleton.vue";
import { Button } from "flowbite-vue";
import { loadStripe } from '@stripe/stripe-js';

defineComponent({
    layout: Layout,
    Button,
    props,
    inheritAttrs:true
});

const props = defineProps({
    paintings: null || Array,
    stripeKey: null | String,
    user: null || Object,
    highEndPainting: null || Object,
    lowEndPainting:null || Object,
    donationLink: null|| Object,
    painting:null || Object,

});

const {
    props: { donationLink, highEndPainting, lowEndPainting, sessionId,paintings },
} = usePage();



provide("paintings", paintings);
provide('donationLink',donationLink);
const handleCheckoutClick = async(painting) =>{


}


const title = ref("Radical Flexibility");
</script>
<script>
export default{
    components:{
        PaintingCard,
        Button,
        PaintingSkeleton
    }
}
</script>
<style scoped>
.card-body {
    color: #d0c4a4;
}
</style>
