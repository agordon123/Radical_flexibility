<template>
    <div class="stripe-buy-button">


<stripe-buy-button
  buy-button-id="buy_btn_1Mu1hBDxs152QbBrO6uYYxeT"
  publishable-key="pk_test_51Mmj2MDxs152QbBr97fqNjqKtSUEyafFaoNgfip4Uj2fwepJ5vnxcutN6GEXPGGq2Ydv9D5vuBIbs1fwmncclwSn00BFSCTNFs"
>
</stripe-buy-button>
    </div>
</template>
<script setup>
import { Button } from 'flowbite-vue';
defineProps({
    buyButtonId:String,
    publishableKey:String,
    type:String,
    href:String
})
</script>
