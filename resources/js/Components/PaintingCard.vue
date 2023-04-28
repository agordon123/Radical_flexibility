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


});
Ziggy.routes["donate.checkout"];

Ziggy.routes["donate.checkout"].methods.entries
const emits = defineEmits(['submit'])
const props = defineProps({
    painting:Object,
    stripeKey:String,
    redirectToCheckout:Function,
    checkoutSession:Object

})


const flag = ref(false);
const stripeKey = inject('stripeKey')

async function redirectToCheckout(painting) {
    let product = painting.product.product_id;
    let painting_id = painting.id;
    console.log(product);
  try {
    const response = await axios.post('/painting/checkout', { product,painting_id });
    const sessionId = response.data.sessionId;

    const stripe = Stripe(props.stripeKey);
    await stripe.redirectToCheckout({ sessionId });
  } catch (error) {
    console.error('Error redirecting to Stripe Checkout:', error);
  }
}

// Call redirectToCheckout with the painting object when needed


</script>
