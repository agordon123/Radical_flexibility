<template v-model="painting.product">
    <div class="bg-primary">
        <form method="post" :v-model="form" action="createDonationCheckoutSession">
<PrimaryButton :type="submit" @click="submit" >

</PrimaryButton>
</form>
    </div>
</template>
<script setup>
import PrimaryButton from "../UI/PrimaryButton.vue";
import { Button } from "flowbite-vue";
import { defineComponent,computed } from "vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
defineComponent({
    type:"submit",
    components:PrimaryButton,
    props:props,
    color:"primary",



});
const createDonationCheckoutSession = async(productID)=>{

}
const {painting:{product:{product_id}}} = computed(()=>usePage().props)
const form = useForm()
const emits = defineEmits(['submit']);
const props =defineProps({

});
</script>



