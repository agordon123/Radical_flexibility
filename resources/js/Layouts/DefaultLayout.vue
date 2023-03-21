<template>
  <div>
    <NavBar />
    <div class="container">
      <slot />
    </div>
  </div>
</template>

<script setup>

import { onMounted, reactive } from "vue";
import { Link } from "@inertiajs/vue3";
import { NavBar } from '@/Components/NavBar.vue';



const Home = {
    setup() {
        const state = reactive({
            products: useProductsStore().products,
        });

        const addToCart = (product) => {
            // logic to add product to cart
        };

        onMounted(() => {
            useProductsStore().fetchProducts();
        });

        return {
            state,
            addToCart,
        };
    },
};

const About = {
    template: "<div>About Us</div>",
};

const FAQ = {
    template: "<div>FAQ</div>",
};

const Donate = {
    template: "<div>Donate</div>",
};

const Gallery = {
    template: "<div>Gallery</div>",
};
</script>
