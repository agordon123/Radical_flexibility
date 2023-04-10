<template>
    <Head :title="title" />
    <Layout
        ><template #default>
            <div class="grid grid-cols-3 max-w-[80%] align-middle container" v-if="paintings">
                <div v-for="painting in paintings" :key="painting.id" class="col col-span-1 inline-flex justify-center">
                    <TheCard
                        variant="image"
                        :img-src="`${painting.filename}`"
                        ref="paintingContainer"
                        :img-alt="`${painting.name}`"
                        :href="`/paintings/${painting.id}`"
                        class="p-10 gap-10 bg-secondary justify-between h-[400px] w-[200px] object-cover mb-10"

                    >
                        <div class="card-body">
                            <h5 class="card-title">{{ painting.title }}</h5>
                            <p class="card-text">{{ painting.description }}</p>
                            <p class="card-text">Artist: {{ painting.name }}</p>
                            <p class="card-text">
                                Price: ${{ painting.price }}
                            </p>
                            <PrimaryButton
                                class="btn btn-primary"
                                type="submit"
                                @click="handleCheckoutClick(painting.price,painting.id)"
                            >
                                Buy Painting
                            </PrimaryButton>
                        </div>
                    </TheCard>
                </div>
                 <PaintingSkeleton v-show="!paintings">

                 </PaintingSkeleton>
            </div>
        </template>
    </Layout>
</template>

<script setup>
import { TheCard } from "flowbite-vue";
import Layout from "@/Layouts/Layout.vue";
import { usePage, Head } from "@inertiajs/vue3";
import { defineComponent, computed } from "vue";
import { ref } from "vue";
import Stripe from 'stripe'
import PaintingSkeleton from "@/Components/Paintings/PaintingSkeleton.vue";
import PrimaryButton from "@/Components/UI/PrimaryButton.vue";

const paintingsData =  computed(() => {
    return renderPaintings()
});
const { props: { paintings } } = usePage()
defineComponent({
    layout: Layout,
    props: {
        paintings: Array,
        stripeKey:String
    },
});
const paintingContainer = ref({})
const renderPaintings = () =>{
    if(props.paintings){
        paintingContainer.value = props.paintings
    }
}
const stripe = new Stripe(  )
const handleCheckoutClick = async(price,id) =>{
    const { sessionId } = await fetch('/create-checkout-session', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          items: [
            {
              price,
              quantity: 1,
            },
          ],
        }),
      }).then((res) => res.json())

      const { error } = await stripe.redirectToCheckout({ sessionId })

      if (error) {
        console.error(error)
      }
    }
const props = defineProps(["paintings"]);
const title = ref("Radical Flexibility");
</script>
