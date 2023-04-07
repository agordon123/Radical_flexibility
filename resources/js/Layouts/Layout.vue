<template>
    <div class="min-h-screen bg-white">
        <header class="bg-white border-b">
            <div class="container mx-auto px-4 py-5">
                <div class="flex items-center justify-center h-20">
                    <application-logo class="h-16 w-auto" />
                    <h1
                        class="text-4xl font-bold ml-4 text-navy-blue drop-shadow-lg font-serif"
                    >
                        Radical Flexibility
                    </h1>
                </div>
                <nav
                    class="bg-navy-blue py-2 shadow-md mt-2 rounded-lg drop-shadow-lg"
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
                        <li>
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
        <main class="container justify-center flex-grow-0 content-center">
            <slot />
        </main>
    </div>
</template>

<script setup>
import ApplicationLogo from "@/Components/UI/ApplicationLogo.vue";
import NavLink from "@/Components/UI/NavLink.vue";
</script>
<script>
export default { components: { NavLink } };
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
