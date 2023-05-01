<template>
    <div></div>
</template>
<script setup>
import StripeElements from '@/Components/StripeComponents/StripeElements.vue';
import { defineComponent } from 'vue';

defineComponent({
    components:{
        StripeElements,
        props
    }
})

const props = defineProps({
    sessionId:null || Object
})
</script>
