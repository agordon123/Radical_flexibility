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




