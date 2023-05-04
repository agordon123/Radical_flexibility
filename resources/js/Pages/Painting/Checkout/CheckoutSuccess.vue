<template>
    <div class="stripe-checkout-success">
        <h2>Payment Successful</h2>
        <p>
            Thank you for your donation! Your transaction has been completed
            successfully.
        </p>
        <button @click="returnToMainPage">Return to Main Page</button>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { defineComponent } from "vue";
defineComponent({
    props,
});
const props = defineProps({
    sessionId: null || String,
});
const returnToMainPage = () => {
    // Replace this with the route to your main page
    router.visit("/");
};
</script>

<style scoped>
.stripe-checkout-success {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

h2 {
    color: green;
}

button {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-radius: 4px;
    color: #495057;
    cursor: pointer;
    font-size: 1rem;
    padding: 0.5rem 1rem;
    margin-top: 1rem;
    transition: background-color 0.2s, color 0.2s;
}

button:hover {
    background-color: #495057;
    color: #f8f9fa;
}
</style>
