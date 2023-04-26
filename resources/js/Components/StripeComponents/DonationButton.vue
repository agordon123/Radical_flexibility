<template #donation>
    <div class="bg-primary">
<slot name="donationProduct" />

    </div>
</template>
<script setup>
import DonationForm from "@/Forms/DonationForm.vue";

import { defineComponent,computed } from "vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
defineComponent({
    type:"submit",
    components:PrimaryButton,DonationForm,
    props:props,




});
const {donationLink} = computed(()=>usePage().props)
const emits = defineEmits(['submit']);
const props =defineProps({
donationLink:Object
});
</script>



