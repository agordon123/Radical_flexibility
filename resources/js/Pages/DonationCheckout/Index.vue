<template>
  <div>
    <h1>Checkout</h1>
    <form @submit.prevent="submit">
      <label>
        Card number
        <input type="text" v-model="cardNumber" />
      </label>
      <label>
        Expiration date
        <input type="text" v-model="expDate" />
      </label>
      <label>
        CVC
        <input type="text" v-model="cvc" />
      </label>
      <button type="submit">Pay</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
const baseURL = 'http://localhost:8000'
const session = await stripe.checkout.sessions.create({
    success_url: `${baseURL}/DonationCheckout/Index`,
  cancel_url: `${baseURL}/DonationCancel/Index`,
  line_items: [
    {price: 'price_xxxxxxxxxxxxx', quantity: 2},
  ],
  mode: 'payment',
})

    const cardNumber = ref('')
    const expDate = ref('')
    const cvc = ref('')

    const submit = async () => {
      const { error } = await stripe.confirmCardPayment(clientSecret.value, {
        payment_method: {
          card: {
            number: cardNumber.value,
            exp_month: expDate.value.split('/')[0],
            exp_year: expDate.value.split('/')[1],
            cvc: cvc.value,
          },
        },
      })

      if (error) {
        // Display error to user
        console.error(error)
      } else {
        // Payment succeeded
        // Redirect to success page or show confirmation to user
      }
    }




</script>
