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
            <p class="card-body text-xl ml-5 mb-5 pb-3">
                Price: ${{ painting.price }}

                <Button :pill="true" class="bg-secondary float-right border-8" type="submit" method="POST"
                    @click="handleCheckoutClick(painting)">Buy Now!</Button>

            </p>
        </div>
    </div>
</template>


<script setup>
import { defineComponent} from "vue";
import { Button } from "flowbite-vue";
import { useForm } from "@inertiajs/vue3";
defineComponent({
    components:{
        Button,

    },
    props: props,
    inheritAttrs:true,
    emits,

});


const emits = defineEmits(['submit'])
const props = defineProps({
    painting:Object,
    stripeKey:String

})
const form = useForm({

})
const handleCheckoutClick = async (painting) => {

    let stripe = loadStripe(props.stripeKey)

    const form = Object.assign({},painting,productId)
    const {
        props: { sessionId },
    } = await fetch("/painting/checkout", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            items: [
                {
                    product_id: props.painting.product.product_id,
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
async function createCheckoutSession(painting) {
    const product_id  = painting.product.product_id;
    const price_id = painting.product.price_id;
    const product = Object.assign({},product_id,price_id);
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
