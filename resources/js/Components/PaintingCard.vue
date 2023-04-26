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
        <form method="POST" @submit.prevent="$emit('submit',handleCheckoutClick(painting.id))">
            <p class="card-body text-xl ml-5 mb-5 pb-3">
                Price: ${{ painting.price }}

                    <input hidden :value="painting.product" />
                <Button :pill="true" class="bg-secondary float-right border-8" type="submit" method="POST"
                :disabled="form.processing">Buy Now!</Button>

            </p>
        </form>
        </div>
    </div>
</template>


<script setup>
import { defineComponent, inject,computed,onBeforeMount} from "vue";
import { Button } from "flowbite-vue";
import { useForm,usePage } from "@inertiajs/vue3";
import { loadStripe } from "@stripe/stripe-js";
import { Ziggy } from "@/ziggy";
defineComponent({
    components:{
        Button,
    },
    props: props,
    emits,

});


const emits = defineEmits(['submit'])
const props = defineProps({
    painting:Object,
    stripeKey:String,
    handleCheckoutClick:Function

})
const {stripeKey,donationLink} = computed(()=>usePage().props)



const handleCheckoutClick = async (painting) => {

    let stripe = loadStripe(stripeKey)
    let productId = painting.product.id;
    let paintingId = painting.id;
    form.painting_id = paintingId;
    form.product_id= productId;

    const {
        props: { sessionId },
    } = await form.post("/painting/checkout",{preserveScroll:true,})
    .then((res) => res.json());

    const { error } = await stripe.redirectToCheckout({ sessionId });

    if (error) {
        console.error(error);
    }
};
async function createCheckoutSession(painting) {
    const product_id  = painting.product.product_id;
    const price_id = painting.product.price_id;
    const product = Object.assign({},product_id,price_id);
    try {

    } catch (error) {

    }
  fetch('/create-checkout-session', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
     product
    })
  })
  .then(response => response.json())
  .then(session => {
    // Redirect the user to the checkout page
    window.location.href = session.url;
  })
  .catch(error => {
    console.error(error);
  });
}


</script>
