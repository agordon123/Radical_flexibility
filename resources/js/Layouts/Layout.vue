<script setup>
import { defineComponent, ref,onMounted } from "vue";
import ApplicationLogo from "@/Components/UI/ApplicationLogo.vue";
import Dropdown from "@/Components/UI/Dropdown.vue";
import DropdownLink from "@/Components/UI/DropdownLink.vue";
import NavLink from "@/Components/UI/NavLink.vue";
import ResponsiveNavLink from "@/Components/UI/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import NavBar from "@/Components/UI/NavBar.vue";
import { initFlowbite } from "flowbite";
import Header from "./Header.vue";

const showingNavigationDropdown = ref(false);
onMounted(()=>initFlowbite())
defineComponent({
    props: {
        ApplicationLogo,
        DropdownLink,
        Dropdown,
        NavLink,
        NavBar,
        ResponsiveNavLink,
        Link,
    },
    name: "Layout",
});
</script>
<template>

        <slot name="header">
            <Header />
            <NavBar class="bg-primary" />
        </slot>

    <template>
        <div class="">
            <main>
                <slot />
            </main>
        </div>
    </template>
    <template>
        <footer>
            <slot name="footer"></slot>
        </footer>
    </template>
</template>
<script>
export default {
    layout: "Layout",
};
</script>
