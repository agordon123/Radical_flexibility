<template>
    <div class="min-h-screen bg-yellow-100 from-transparent to-yellow-600">
        <header class="from-bg-amber-400 opacity-90 border-b backdrop:blur-lg">
            <div class="container mx-auto px-4 py-5">
                <div
                    class="flex items-center justify-center h-[100px] flex-row hover:border-l-orange-100"
                >
                    <ApplicationLogo
                        class="h-[200px] w-20 mr-5 text-brown font-extrabold"
                    />
                    <h1
                        class="text-6xl font-bold ml-10 text-brown drop-shadow-lg font-ui-sans-serif underline"
                    >
                        Radical Flexibility Fund
                    </h1>
                    <div
                        class="ml-[100px] mr-[100px] p-4 text-xl font-bold align-baseline"
                    >

                   <DonationButton @submit="$emit('submit')" />
                    </div>
                    <div>
                        <a href="https://instagram.com/radicalflexibility"
                            ><i
                                class="fa fa-instagram text-secondary"
                                style="font-size: 36px"
                            ></i></a
                        ><span class="px-4">Check Out our Instagram!</span>
                    </div>
                    <div class="float-right"><Link href="/login"> </Link></div>
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
                                href="/About"
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
import { defineComponent } from "vue";
import NavLink from "@/Components/UI/NavLink.vue";
import ApplicationLogo from "@/Components/UI/ApplicationLogo.vue";
import DonationButton from "@/Components/StripeComponents/DonationButton.vue";

defineComponent({
    components: {
        ApplicationLogo,
        NavLink,
        DonationButton,
    },
    inheritAttrs:true,
    props,
    emits,
});

const props = defineProps({
    stripeKey:{
        type:String
    },
    sessionId:{
        type:Object
    },
    product:{
        type:Object
    }
});


const emits = defineEmits(["submit"]);


</script>
<style>
.text-gold-accent {
    color: #ddc267;
}
</style>
