<template>
    <div class="bg-primary">
        <Button color="text-accent">

        </Button>
    </div>
</template>
<script setup>
import { Button } from "flowbite-vue";
import { defineComponent } from "vue";

defineComponent('DonationButton',{
    type:"submit",
    components:Button,
    props:props,
    color:"primary",


});

const props =defineProps({
    buyButtonId: String,
    publishableKey: String,
    type: String,
    href: String,
});
</script>
