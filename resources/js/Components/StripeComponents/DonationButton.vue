<template>
    <div class="bg-primary">
        <form>
        <Button color="text-accent" type="type">
            <slot name="donation"></slot>

        </Button>
    </form>
    </div>
</template>
<script setup>
import { Button } from "flowbite-vue";
import { defineComponent } from "vue";
import { Link } from "@inertiajs/vue3";
defineComponent({
    type:"submit",
    components:Button,
    props:props,
    color:"primary",



});
const createDonationCheckoutSession = async(productID)=>{

}
const emits = defineEmits([])
const props =defineProps({
    buyButtonId: String,
    publishableKey: String,
    type: String,
    href: String,
});
</script>



