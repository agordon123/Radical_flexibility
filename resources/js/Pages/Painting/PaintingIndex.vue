<template v-model="painting">
        <div class="flex align-middle justify-center" ref="paintingContainer">
            <table class="table-auto">
                <thead>
                    <tr>

                    </tr>
                </thead>
            </table>
          <h1>Checkout</h1>
          <p>Total: ${{ amount }}</p>
          <form @submit.prevent="handleSubmit">
            <button type="submit">Pay Now</button>
          </form>
        </div>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import route from "vendor/tightenco/ziggy/src/js";
import { computed, defineComponent, ref,unref } from "vue";
app.config.globalProperties.route = route
const {props:{painting} } = computed(()=> usePage())
console.log(paintings.value)
defineComponent({
    painting:Object,
    required:true,
})
const paintingContainer = ref({});
</script>
