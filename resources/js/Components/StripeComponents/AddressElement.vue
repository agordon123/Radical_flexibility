<script setup>
import { usePage,useForm } from '@inertiajs/vue3';
import {loadStripe} from '@stripe/stripe-js';
import Stripe from 'stripe';
import { defineComponent } from 'vue';
defineComponent({
    publishableKey:String,

})
const publishableKey = usePage().props.publishableKey
const {props} = usePage();
const stripe = Stripe(publishableKey);
</script>
<template>
    <form id="address-form">
        <h3>Address</h3>
        <div id="address-element">
          <!-- Elements will create form elements here -->
        </div>
      </form>
</template>
