<template>
    <div class="min-h-screen bg-white">
        <header class="bg-white border-b border-gray-200">
            <div class="container mx-auto px-4 py-5">
                <div class="flex items-center justify-center h-16">
                    <application-logo class="h-12 w-auto" />
                    <h1
                        class="text-4xl font-bold ml-4 text-navy-blue drop-shadow-lg"
                    >
                        Radical Flexibility
                    </h1>
                </div>
                <nav
                    class="bg-navy-blue py-2 shadow-md mt-4 rounded-lg drop-shadow-lg"
                >
                    <ul class="flex justify-between space-x-4 mx-auto">
                        <li>
                            <a
                                href="#"
                                class="text-gold-accent font-semibold hover:underline"
                                >Home</a
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="text-gold-accent font-semibold hover:underline"
                                >Art Gallery</a
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="text-gold-accent font-semibold hover:underline"
                                >Donate</a
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="text-gold-accent font-semibold hover:underline"
                                >Contact Us</a
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="text-gold-accent font-semibold hover:underline"
                                >FAQ</a
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="text-gold-accent font-semibold hover:underline"
                                >Admin Panel</a
                            >
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <main
            class="container max-w-[80%] items-center justify-center ml-[6%] mr-[6%] flex-grow-0"
        >
            <slot />
        </main>
    </div>
</template>

<script setup>
import ApplicationLogo from "@/Components/UI/ApplicationLogo.vue";
</script>
<script>
export default {};
</script>
<style>
.text-navy-blue {
    color: #0c264f;
}
.bg-navy-blue {
    background-color: #0c264f;
}
.text-gold-accent {
    color: #d4af37;
}
</style>
