<!-- resources/js/Pages/Checkout/Index.vue -->
<template>
    <div>
        <form
            action="{{ route('checkout.process') }}"
            method="POST"
            id="payment-form"
        >
            @csrf
            <input type="hidden" name="sessionId" :value="sessionId" />
            <input type="hidden" name="publicKey" :value="publicKey" />

            <div id="card-element"></div>
            <button @click.prevent="handleSubmit">Pay Now</button>
        </form>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { usePage } from "@inertiajs/vue3";
import { loadStripe } from "@stripe/stripe-js";

export default defineComponent({
    setup() {
        const { props } = usePage();
        const stripe = loadStripe(props.publicKey);

        const handleSubmit = async () => {
            const { sessionId } = document.querySelector("#payment-form");
            const { error, paymentMethod } = await stripe.createPaymentMethod(
                "card",
                document.getElementById("card-element")
            );

            if (error) {
                console.error(error.message);
            } else {
                const { clientSecret } = await fetch(
                    "/checkout/create-payment-intent",
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            amount: 1000,
                            currency: "usd",
                            payment_method: paymentMethod.id,
                            description:
                                "An example payment for testing Stripe Checkout",
                        }),
                    }
                ).then((res) => res.json());
                const { error } = await stripe.confirmCardPayment(clientSecret);

                if (error) {
                    console.error(error.message);
                } else {
                    window.location.href = "/checkout/success";
                }
            }
        };

        return {
            props,
            stripe,
            handleSubmit,
        };
    },
});
</script>
