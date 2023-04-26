<script setup>
import { computed, defineComponent, onMounted,inject } from "vue";
import { Button } from "flowbite-vue";
import PrimaryButton from "@/Components/UI/PrimaryButton.vue";
import { useForm, usePage } from "@inertiajs/vue3";
defineComponent({
    components: {
        Button,
    },
    props,
    emits
});
const props = defineProps({
    donationLink: { type: Object},
    form:{type:useForm},
});
const emits = defineEmits(["submit"]);
const form = useForm({
    donationLink:{}
});
const {product} = computed(()=>usePage().props.donationLink);
const donate = async () => {
    const url = props.donationLink ? `/donate/checkout` : null;
    console.log(url)
    if(url!==null)
    try {
        const response = await form.post(url, {
            product
        }).then((response)=>{
            const sessionId = response.data.sessionId;
            window.location.href = `/checkout/${sessionId}`;
        })




    } catch (error) {
        console.error(error);
    }
};
const donationLink = inject('donationLink');

</script>
<template #donation>
    <div>
        <form
            v-bind="{donationLink}"
            method="POST"
            @submit="$emit('submit',donationLink)"
        >
            <div
                v-for="(value,key) in donationLink"
                :key="key" >
                <div v-if="value == donationLink.product">
                    <input :value="donationLink.product">
                </div>
            </div>
            <PrimaryButton
                type="submit"
                aria-label="DonationButton"
                v-on:click="submit"
                class="rounded-2xl bg-primary"

            >Click to Contribute to the Cause! </PrimaryButton>
        </form>
    </div>
</template>
