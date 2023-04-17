<template>
    <header class="from-bg-amber-400 opacity-90 border-b backdrop:blur-lg">
        <div class="container mx-auto px-4 py-5">
            <div
                class="flex items-center justify-center h-[100px] flex-row hover:border-l-orange-100"
            >
                <ApplicationLogoVue
                    class="h-[80%] w-20 text-secondary font-extrabold"
                />
                <h1
                    class="text-5xl font-bold ml-10 text-secondary drop-shadow-lg font-ui-sans-serif underline"
                >
                    Radical Flexibility Fund
                </h1>
                <div class="mx-20 text-xl bold bg-secondary">
                    <form
                        action="POST"
                        @submit.prevent="form.post('/create-checkout-session')"
                    >
                        <Button
                            id="checkout-button"
                            class="bg-primary hover:bg-secondary w-[200px]"
                            size="xl"
                            background="bg-primary"
                            type="submit"
                            >DONATE NOW</Button
                        >
                    </form>
                </div>
                <div>
                    <a href="https://instagram.com/radicalflexibility"
                        ><i
                            class="fa fa-instagram text-secondary"
                            style="font-size: 36px"
                        ></i></a
                    ><span class="px-4">Check Out our Instagram!</span>
                </div>
                <div class="float-right"><Link href="/login">
                </Link></div>
            </div>
            <nav
                class="bg-primary py-2 shadow-md mt-10 rounded-lg drop-shadow-lg"
            >
                <ul class="flex justify-between space-x-4 ml-4 mr-4">
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
</template>
<script setup>
import ApplicationLogoVue from "@/Components/UI/ApplicationLogo.vue";
import NavLink from "@/Components/UI/NavLink.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { Button } from "flowbite-vue";
import { defineComponent, onMounted,computed } from "vue";
defineComponent({
    ApplicationLogoVue,
    NavLink,
    Link,
    Button,
});
const page = computed(()=>usePage());

const logProducts = ()=>{
    page.props.products.forEach(element => {
        console.log(element);
    });
}


defineEmits(["handleDonationClick", "createCheckoutSession","submit","logProducts"]);
//onMounted(()=>);
defineProps({ sessionId: Object, products: Array });

const submit = async () => {
    const {
        props: { sessionId },
    } = await form
        .post("/create-checkout-session", {
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
        })
        .then((res) => res.json());

    const { error } = await stripe.redirectToCheckout({ sessionId });

    if (error) {
        console.error(error);
    }
};
const createCheckoutSession = async (product_id) => {
    try {
        const response = await axios.post("/create-checkout-session", {
            price: props.price,
        });

        const sessionId = response.data.sessionId;

        window.location.href = `/checkout/${sessionId}`;
    } catch (error) {
        console.error(error);
    }
};
</script>
