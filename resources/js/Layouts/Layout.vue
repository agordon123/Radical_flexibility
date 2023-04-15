<template>
    <div class="min-h-screen bg-yellow-100 from-transparent to-yellow-600">
        <Header ></Header>
        <main class="flex content-center align-middle">
            <slot />
        </main>
    </div>
</template>

<script setup>
import Header from "./Header.vue";
import ApplicationLogo from "@/Components/UI/ApplicationLogo.vue";
import NavLink from "@/Components/UI/NavLink.vue";
import { usePage } from "@inertiajs/vue3";
import { Button } from "flowbite-vue";
import Stripe from "stripe";
import {Link} from "@inertiajs/vue3";
import { computed, ref } from "vue";
const donationLink = ref('https://donate.stripe.com/test_14kg1V1RD7wP7u07su')
const loading = ref(false);
const handleDonationClick = async () => {
    const {
        props: { sessionId },
    } = await fetch("/create-checkout-session", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            items: [
                {
                    price: 0,
                    quantity: 1,
                },
            ],
        }),
    }).then((res) => res.json());

    const { error } = await stripe.redirectToCheckout({ sessionId });

    if (error) {
        console.error(error);
    }
};
</script>
<style>
.text-gold-accent {
    color: #ddc267;
}
</style>
