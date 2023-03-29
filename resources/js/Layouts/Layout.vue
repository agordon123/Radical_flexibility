<script setup>
import { defineComponent, ref } from "vue";
import ApplicationLogo from "@/Components/UI/ApplicationLogo.vue";
import Dropdown from "@/Components/UI/Dropdown.vue";
import DropdownLink from "@/Components/UI/DropdownLink.vue";
import NavLink from "@/Components/UI/NavLink.vue";
import ResponsiveNavLink from "@/Components/UI/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import NavBar from "@/Components/UI/NavBar.vue";
const showingNavigationDropdown = ref(false);
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
    <div class="flex flex-row min-h-[full-screen] text-primary container">
        <slot name="header">
            <NavBar class="bg-primary" />
        </slot>
    </div>
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
