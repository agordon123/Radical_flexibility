// Set your publishable key: remember to change this to your live publishable key in production

const { loadStripe } = require("@stripe/stripe-js");

// See your keys here: https://dashboard.stripe.com/apikeys
import Stripe from 'stripe';
const stripe = new Stripe(process.env.VITE_STRIPE_SECRET_KEY, {
  apiVersion: '2022-11-15',
});


export default {stripe}
