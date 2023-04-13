<template>
    <div class="min-h-screen bg-yellow-100 from-transparent to-yellow-600">
        <header class="from-bg-amber-400 opacity-90 border-b backdrop:blur-lg">
            <div class="container mx-auto px-4 py-5">
                <div
                    class="flex items-center justify-center h-[100px] flex-row hover:border-l-orange-100"
                >
                    <application-logo
                        class="h-[80%] w-20 text-secondary font-extrabold"
                    />
                    <h1
                        class="text-5xl font-bold ml-10 text-secondary drop-shadow-lg font-ui-sans-serif"
                    >
                        Radical Flexibility Fund
                    </h1>
                    <div class="mx-20 text-xl bold bg-secondary">

                        ><Link :href="'/donate'">
                            <Button
                                id="checkout-button"
                                class="bg-primary hover:bg-secondary w-[200px]"
                                size="xl"
                                background="bg-primary"
                                @click="handleCheckoutClick"
                                @click.prevent="loading"
                                type="submit"
                                >DONATE NOW</Button
                            >
                        </Link>
                    </div>
                    <div>
                        <a href=""
                            ><i
                                class="fa fa-instagram text-secondary"
                                style="font-size: 36px"
                            ></i></a
                        ><span class="px-4">Check Out our Instagram!</span>
                    </div>
                </div>
                <nav
                    class="bg-primary py-2 shadow-md mt-10 rounded-lg drop-shadow-lg font-serif"
                >
                    <ul
                        class="flex justify-between space-x-4 ml-4 mr-4 text-primary"
                    >
                        <li>
                            <NavLink
                                href="/"
                                class="text-gold-accent font-semibold hover:underline"
                                >Home
                            </NavLink>
                        </li>
                        <li>
                            <NavLink
                                href="/Gallery"
                                class="text-gold-accent font-semibold hover:underline"
                                >Art Gallery</NavLink
                            >
                        </li>
                        <li>
                            <NavLink
                                href="/checkout"
                                class="text-gold-accent font-semibold hover:underline"
                                >About the Organization</NavLink
                            >
                        </li>
                        <li>
                            <NavLink
                                href="#"
                                class="text-gold-accent font-semibold hover:underline"
                                >Past Campaigns</NavLink
                            >
                        </li>
                        <li>
                            <NavLink
                                href="#"
                                class="text-gold-accent font-semibold hover:underline"
                                >Contact Us</NavLink
                            >
                        </li>
                        <li v-if="user">
                            <NavLink
                                href="#"
                                class="text-gold-accent font-semibold hover:underline"
                                >Admin Panel</NavLink
                            >
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <main class="flex content-center align-middle">
            <slot />
        </main>
    </div>
</template>

<script setup>
import ApplicationLogo from "@/Components/UI/ApplicationLogo.vue";
import NavLink from "@/Components/UI/NavLink.vue";
import { usePage } from "@inertiajs/vue3";
import { Button } from "flowbite-vue";
import Stripe from "stripe";
import {Link} from "@inertiajs/vue3";
import { computed, ref } from "vue";
import { loadStripe } from "@stripe/stripe-js";
const user = usePage().props.auth.user;
const stripeKey =computed(usePage().props.secretKey)
const stripe = new Stripe(stripeKey);
const handleCheckoutClick = async () => {
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
const loading = ref(false);
</script>
<style>
.text-gold-accent {
    color: #ddc267;
}
</style>
