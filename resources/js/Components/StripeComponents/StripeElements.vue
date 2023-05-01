<template>
    <div class="stripe-elements">
      <form @submit.prevent="handleSubmit">
        <div id="card-element" ref="cardElement"></div>
        <button type="submit" :disabled="isProcessing">Submit Payment</button>
      </form>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        stripe: null,
        elements: null,
        card: null,
        isProcessing: false,
      };
    },
    mounted() {
      this.stripe = Stripe("your_stripe_publishable_key");
      this.elements = this.stripe.elements();
      this.card = this.elements.create("card");
      this.card.mount(this.$refs.cardElement);

      // Handle real-time validation errors
      this.card.addEventListener("change", (event) => {
        if (event.error) {
          console.error(event.error.message);
        }
      });
    },
    methods: {
      async handleSubmit() {
        this.isProcessing = true;

        // Create a payment method using the card element
        const { error, paymentMethod } = await this.stripe.createPaymentMethod({
          type: "card",
          card: this.card,
        });

        if (error) {
          console.error("Error creating payment method:", error);
          this.isProcessing = false;
          return;
        }

        // Call your backend to create a charge or subscription using the payment method ID
        // e.g., axios.post('/charge', { paymentMethodId: paymentMethod.id })

        this.isProcessing = false;
      },
    },
  };
  </script>

  <style scoped>
  /* Add your custom styles for the Stripe Elements form here */
  </style>
