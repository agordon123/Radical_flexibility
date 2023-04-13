<template #donation>
    <stripe-buy-button
    buyButtonId="buy_btn_1Mu1hBDxs152QbBrO6uYYxeT"
    publishableKey="pk_test_51Mmj2MDxs152QbBr97fqNjqKtSUEyafFaoNgfip4Uj2fwepJ5vnxcutN6GEXPGGq2Ydv9D5vuBIbs1fwmncclwSn00BFSCTNFs"
  >
  </stripe-buy-button>
</template>
<script setup>
import { defineComponent } from "vue"

defineComponent({
    props
})
const props = defineProps({
    buyButtonId:String,
    publishableKey:String
})
defineEmits({})
</script>
