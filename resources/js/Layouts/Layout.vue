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
                        class="ml-[100px] mr-[100px]  p-4 text-xl font-bold bg-primary align-baseline"

                    >
<DonationForm  />
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
        <main class="flex content-center align-middle">
            <slot />
        </main>
    </div>
</template>

<script setup>
import {  defineComponent, ref,computed,inject, watchEffect } from "vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { Button } from "flowbite-vue";
import NavLink from "@/Components/UI/NavLink.vue";
import ApplicationLogo from "@/Components/UI/ApplicationLogo.vue";
import DonationForm from "@/Forms/DonationForm.vue";
defineComponent({components:{
    ApplicationLogo,
    NavLink,
    Link,
    Button,
    DonationForm
    },
    inheritAttrs:true,
    props,
    emits





})
const paintings = inject('paintings')
const props = defineProps({
    donationLink:{type:Object,
    required:true,}
})
const {donationLink} = computed(()=>usePage().props);
watchEffect()
const emits = defineEmits(['donate'])

const form = useForm({
   ...donationLink

})
const donate = async () => {
    console.log(form);
    console.log({donationLink})
  //  const url =props.donationLink ? `/donate/checkout` : null;
    //try {
     //   const response = await form.post("/donate/checkout", {
     //       product_id: form.product.product_id
     //   });

    //    const sessionId = response.data.sessionId;

   //     window.location.href = `/checkout/${sessionId}`;
  //  } catch (error) {
  //      console.error(error);
  //  }
};
</script>
<style>
.text-gold-accent {
    color: #ddc267;
}
</style>
