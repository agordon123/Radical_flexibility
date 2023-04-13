<template>
    <div class="bg-primary">
        <Button color="text-accent" type="type">
            <slot name="donation"></slot>

        </Button>
    </div>
</template>
<script setup>
import { Button } from "flowbite-vue";
import { defineComponent } from "vue";
import { Link } from "@inertiajs/vue3";
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



