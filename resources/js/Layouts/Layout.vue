<template>
    <div class="min-h-screen bg-white">
        <header class="bg-white border-b">
            <div class="container mx-auto px-4 py-5">
                <div class="flex items-center justify-center h-20 flex-row">
                    <application-logo class="h-16 w-auto" />
                    <h1
                        class="bg-primary text-4xl font-bold ml-4 text-navy-blue drop-shadow-lg font-serif"
                    >
                        Radical Flexibility
                    </h1>
                    <div class="mx-10 px-10 bg-primary text-primary">
                        <DonationButton />
                    </div>
                </div>
                <nav
                    class="bg-primary py-2 shadow-md mt-2 rounded-lg drop-shadow-lg"
                >
                    <ul
                        class="flex justify-between space-x-4 ml-4 mr-4 text-primary"
                    >
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
                                >Donate</NavLink
                            >
                        </li>
                        <li>
                            <NavLink
                                href="#"
                                class="text-gold-accent font-semibold hover:underline"
                                >Contact Us</NavLink
                            >
                        </li>
                        <li>
                            <NavLink
                                href="#"
                                class="text-gold-accent font-semibold hover:underline"
                                >FAQ</NavLink
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
        <main class="container justify-center flex-grow-0 content-center align-center">
            <slot />
        </main>
    </div>
</template>

<script setup>
import ApplicationLogo from "@/Components/UI/ApplicationLogo.vue";
import NavLink from "@/Components/UI/NavLink.vue";
import DonationButton from "@/Components/StripeComponents/DonationButton.vue";
import { usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user
</script>
<script>
</script>
<style>
.text-navy-blue {
    color: #0c264f;
}

.text-gold-accent {
    color: #d4af37;
}
</style>
