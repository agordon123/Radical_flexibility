<template #default>
    <form id="payment-form" data-secret="<?= $intent->client_secret ?>">
        <div id="payment-element">
          <!-- Elements will create form elements here -->
        </div>
        </form>
</template>

<script setup>
import { ref } from "vue";
import { loadStripe } from "@stripe/stripe-js";
import { useForm,usePage } from "@inertiajs/vue3";
import {StripeCheckout  } from '@vue-stripe/vue-stripe'
StripeCheckout()
const email = ref("");
const amount = ref(0);
const currency = ref("usd");
const { data, post, processing, errors, reset } = useForm({
      name: '',
      email: '',
      card: null,
    });
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
