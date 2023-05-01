<script setup>
import { defineAsyncComponent,inject } from "vue";
import { Button } from "flowbite-vue";
import axios from "axios";
defineAsyncComponent({
    components:{
        Button
    },
    props,
    emits
});
const props = defineProps({
        redirectToCheckout:{
            type:Function,
            required:false
        }
})
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const donationLink = inject('donationLink');
const emits = defineEmits(["submit"]);
const stripeKey = inject('stripeKey');
const redirectToCheckout = async(donationLink) =>{
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
    price_id = donationLink.price_id;
    console.log(price_id);

    let url = "/donate/checkout";
    try {
        const response = await axios.post(url, { price_id });
        let stripe = await window.Stripe(stripeKey);
        const sessionId = response.data.id;
        await stripe.redirectToCheckout({ sessionId });
    } catch (error) {
        console.error("Error redirecting to Stripe Checkout:", error);
    }
}
</script>
<template>
    <div>
        <form v-bind="donationLink" @submit="$emit('submit',redirectToCheckout(donationLink))" method="POST">

                <Button
                    type="submit"
                    aria-label="DonationButton"
                    v-on:click="submit"
                    class="rounded-2xl bg-primary z-50 outline-1 outline-yellow-300"
                    >Click to Contribute to the Cause!
                </Button>

        </form>
    </div>
</template>


