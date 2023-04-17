<template>
    <div class="min-h-screen bg-yellow-100 from-transparent to-yellow-600">
        <Header ></Header>
        <main class="flex content-center align-middle">
            <slot />
        </main>
    </div>
</template>

<script setup>
import Header from "./Header.vue";
import {  defineComponent, ref } from "vue";

defineComponent({
    Header

})



</script>
<style>
.text-gold-accent {
    color: #ddc267;
}
</style>
