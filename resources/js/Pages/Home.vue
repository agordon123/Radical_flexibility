<template>
    <Head :title="title" />
    <Layout>
        <template #default>
            <div
                class="grid grid-cols-3 max-w-[80%] col-auto mx-auto 2xl:grid grid-flow-row items-center"
                v-if="paintings"
            >
                <template v-for="painting in paintings" :key="painting.id">
                    <PaintingCard :painting="painting" :stripe-key="stripeKey" />
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
    components:{
        PaintingCard,PaintingSkeleton,Button
    },

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
    sessionId:null || Object,
    csrf_token:null || String

});

const {
    props: { donationLink,sessionId,paintings,stripeKey,user,csrf_token },
} = usePage();


console.log(csrf_token)
provide("paintings", paintings);
provide('donationLink',donationLink);
provide('stripeKey',stripeKey);
provide('xsrf',csrf_token);


const title = ref("Radical Flexibility");
</script>
<style scoped>
.card-body {
    color: #d0c4a4;
}
</style>
