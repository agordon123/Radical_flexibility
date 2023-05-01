<template>
   <Layout>
    <template>
        <StripeElements />
    </template>
   </Layout>
</template>
<script setup>
import { defineAsyncComponent } from 'vue'
import Layout from '../../../Layouts/Layout.vue'
import StripeElements from '../../../Components/StripeComponents/StripeElements.vue'
defineAsyncComponent({
    components:{
        Layout,
        StripeElements
    },
    props,
    inheritAttrs:true
})
const props = defineProps({
    paymentIntent:null || Object,
    session: null || String
})
</script>
