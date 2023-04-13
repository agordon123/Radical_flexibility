<template>
        <div class="flex align-middle justify-center" ref="paintingContainer">

          <h1>Checkout</h1>
          <p>Total: ${{ amount }}</p>
          <form @submit.prevent="handleSubmit">
            <button type="submit">Pay Now</button>
          </form>
        </div>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import { defineComponent, ref } from "vue";

const {props:{painting} } = usePage();
defineComponent({
    painting:Object,
    required:true,
})
const paintingContainer = ref({});
</script>
