<script setup>
import { defineComponent } from "vue";
import { Button } from "flowbite-vue";
defineComponent({
    props: {
        donationLink: {
            type: Object,
            required: true,
        },
    },
});
const donationLink = inject('donationLink');
</script>
<template #donationProduct v-for="(value, key) in donationLink" key="key">
    <div v-if="key==id">
        <form method="POST" :v-bind="donationLink.id">

            <Button :pill="true" >DONATE NOW</Button>
        </form>
    </div>
</template>
