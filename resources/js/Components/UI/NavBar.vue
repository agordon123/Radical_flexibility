<template>
    <div
        class="flex items-center flex-shrink-0 text-primary justify-center mt-10 drop-shadow-sm shadow-amber-400"
    >
        <ApplicationLogo />
        <span class="text-2xl ml-8 font-serif">Radical Flexibility</span>
    </div>
    <br />
    <nav
        class="flex items-center justify-between flex-wrap bg-white p-6 w-full"
    >
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <!-- navbar links or buttons go here -->
        </div>
    </nav>
</template>

<script setup>
import PrimaryButton from "./PrimaryButton.vue";
import ApplicationLogo from "./ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>
<script></script>
