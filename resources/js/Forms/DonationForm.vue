<script setup>
import { defineComponent } from "vue";
import { Button } from "flowbite-vue";
defineComponent({
    components: {
        Button,
    },
    props,
});
const props = defineProps({
    donationLink: { type: Object, required: true },
    createDonationCheckout: {type:SubmitEvent,required:true},
});
const createDonationCheckout = async (donationLink) => {
    const { donation } = donationLink;
    console.log(donation);
};
const emits = defineEmits(["change", "update", "submit"]);
</script>
<template>
    <div>
        <form
            :v-model="donationLink"
            method="POST"
            enctype="multipart/form-data"
            @submit="createDonationCheckout(donationLink)"
        >
            <input
                hidden
                v-for="(value, index, key) in donationLink"
                :key="key" :value="(value,index)"
            />
            <Button
                type="submit"
                aria-label="DonationButton"
                :pill="true"
                v-on:click="submit"
            />
        </form>
    </div>
</template>
