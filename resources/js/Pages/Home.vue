<template>
    <Head :title="title" />
    <Layout
        ><template #default>
            <div
                class="grid grid-cols-3  max-w-[80%] col-auto mx-auto 2xl:grid grid-flow-row items-center"
                v-if="paintings"
            >
                <div v-for="painting in paintings" :key="painting.id">
                    <div
                        ref="paintingContainer"
                        :img-alt="`${painting.name}`"
                        class="mx-10 z-10 bg-primary shadow-lg object-contain justify-between my-10 drop-shadow-2xl rounded-lg"
                        aria-describedby="picture"
                    >
                        <div
                            class="align-middle col-span-1 justify-items-center object-center"
                        >
                            <a :href="`/paintings/${painting.id}`">
                                <img
                                    :src="`${painting.filename}`"
                                    class="h-[65%] py-7 px-10 border-spacing-7 rounded-2xl z- border-white border-t-white"
                            /></a>
                        </div>
                        <div class="ml-5 mb-2">
                            <span class="card-body text-2xl">{{
                                painting.description
                            }}</span>
                        </div>
                        <p class="card-body text-xl ml-5 mb-5 pb-3">
                            Price: ${{ painting.price }}
                            <Button
                                :pill="true"
                                class="bg-secondary float-right border-8"
                                type="submit"
                                method="POST"
                                @click="
                                    handleCheckoutClick(
                                        painting.price,
                                        painting.id
                                    )
                                "
                                >Buy Now!</Button
                            >
                        </p>

                    </div>
                </div>
                <PaintingSkeleton v-show="!paintings"> </PaintingSkeleton>
            </div>
        </template>
    </Layout>
</template>

<script setup>
import Layout from "@/Layouts/Layout.vue";
import { usePage, Head } from "@inertiajs/vue3";
import { defineComponent, computed, onMounted } from "vue";
import { ref } from "vue";
import PaintingSkeleton from "@/Components/Paintings/PaintingSkeleton.vue";
import { Button } from "flowbite-vue";

const apiKey = ref("");

const paintingsData = computed(() => {
    return renderPaintings();
});
const stripeRef = ref({});

const {
    props: { paintings },
} = usePage();
defineComponent({
    layout: Layout,
    props: {
        paintings: Array,
        stripeKey: String,
        sessionId: String,
        Button,
        paymentLinks: Array,
    },
});
const paintingContainer = ref({});
const paymentLinkContainer = ref({});
const renderPaintings = () => {
    if (props.paintings) {
        paintingContainer.value = props.paintings;
    }
    if (props.paymentLinks) {
        paymentLinkContainer.value = props.paymentLinks;
    }
    console.log(paintingContainer, paymentLinkContainer);
};
const handleCheckoutClick = async (price, id) => {
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
                    price: painting.price,
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
const title = ref("Radical Flexibility");
</script>
<style scoped>
.card-body {
    color: #d0c4a4;
}
</style>
