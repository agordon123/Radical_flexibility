<template v-model="painting" :key="painting.id">

    <div ref="painting"
        class="mx-10 z-10 bg-primary shadow-lg object-contain justify-between my-10 drop-shadow-2xl rounded-lg"
        aria-describedby="picture">
        <div class="align-middle col-span-1 justify-items-center object-center">
            <a :href="`/paintings/${painting.id}`">
                <img :src="`${painting.filename}`"
                    class="h-[65%] py-7 px-10 border-spacing-7 rounded-2xl z-2 border-white border-t-white" /></a>
        </div>
        <div class="ml-5 mb-2">
            <span class="card-body text-2xl">{{
                painting.description
            }}</span>
        </div>
        <div v-if="
            painting.highend
                ? (painting.price = '200.00')
                : (painting.price = '15.00')
        ">
        <form method="POST" @submit.prevent="$emit('submit',redirectToCheckout(painting))">
            <p class="card-body text-xl ml-5 mb-5 pb-3">
                Price: ${{ painting.price }}

                    <input hidden :value="painting.product" />
                <Button :pill="true" class="bg-secondary float-right border-8" type="submit" method="POST"
                :disabled="flag">Buy Now!</Button>

            </p>
        </form>
        </div>
    </div>
</template>


<script setup>
import { defineAsyncComponent, reactive,ref,inject, unref} from "vue";
import { Button } from "flowbite-vue";
import { useForm,usePage } from "@inertiajs/vue3";
import { loadStripe } from "@stripe/stripe-js";
import { Ziggy } from "@/ziggy";
import axios from "axios";
import Stripe from "stripe";
defineAsyncComponent({
    components:{
        Button,
    },
    props: props,
    emits,
    inheritAttrs:true


});
Ziggy.routes["donate.checkout"];

Ziggy.routes["donate.checkout"].methods.entries


// Retrieve the CSRF token
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Set the CSRF token in Axios request headers


// Now you can make your POST request with the painting data
// ...

const emits = defineEmits(['submit'])
const props = defineProps({
    painting:Object,
    stripeKey:String,
    redirectToCheckout:Function,
    checkoutSession:Object,


})


const flag = ref(false);
const stripeKey = inject('stripeKey')
const stripe = window.Stripe(props.stripeKey);
async function redirectToCheckout(painting) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
    let product = painting.product.price_id;
    let painting_id = painting.id;
    console.log(product);
  try {
    const response = await axios.post('/painting/checkout', { product,painting_id });
    const sessionId = response.data.id;


    await stripe.redirectToCheckout({ sessionId });
  } catch (error) {
    console.error('Error redirecting to Stripe Checkout:', error);
  }
}

// Call redirectToCheckout with the painting object when needed
//{"id":"cs_test_a1tbVN3duynRA9pMRCfSRdJiKzjlKd0xDgw8zr5CmyV5Gqfs9viDZALX0o",
//"object":"checkout.session","after_expiration":null,"allow_promotion_codes":null,"amount_subtotal":20000,"amount_total":20000,"automatic_tax":{"enabled":false,"status"

</script>
