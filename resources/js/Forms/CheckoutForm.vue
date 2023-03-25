<template #default>
    <form @submit.prevent="handleSubmit">
        <label>Email Address</label>
        <input type="email" v-model="email" />

        <label>Donation Amount</label>
        <input type="number" v-model="amount" />

        <label>Currency</label>
        <select v-model="currency">
            <option value="usd">USD</option>
            <option value="eur">EUR</option>
            <option value="gbp">GBP</option>
        </select>

        <button @click="handleCheckout">Submit Donation</button>
    </form>
</template>

<script setup>
import { reactive } from "vue";
import { ref } from "vue";
import { loadStripe } from "@stripe/stripe-js";

const email = ref("");
const amount = ref(0);
const currency = ref("usd");

const stripePromise = loadStripe(process.env.STRIPE_PUBLIC_KEY);

const handleCheckout = async () => {
    const stripe = await stripePromise;

    const { error } = await stripe.redirectToCheckout({
        lineItems: [{ price: process.env.STRIPE_PRICE_ID, quantity: 1 }],
        mode: "payment",
        customerEmail: email.value,
        successUrl: process.env.STRIPE_SUCCESS_URL,
        cancelUrl: process.env.STRIPE_CANCEL_URL,
        payment_method_types: ["card"],
        payment_intent_data: {
            amount: amount.value * 100,
            currency: currency.value,
            description: "Donation",
        },
    });

    if (error) {
        console.error(error.message);
    }
};

const handleSubmit = () => {
    handleCheckout();
};

return { email, amount, currency, handleSubmit };
</script>
