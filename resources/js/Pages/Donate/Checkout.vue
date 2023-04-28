<template>
    <div>
      <p>Checkout session ID: {{ checkoutSession.id }}</p>
      <!-- Display other properties of the checkout session as needed -->
    </div>
  </template>
<script setup>

defineProps({
    checkoutSession:Object
})
  </script>
