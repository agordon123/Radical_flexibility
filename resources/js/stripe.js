import process from 'process';
// See your keys here: https://dashboard.stripe.com/apikeys
import Stripe from 'stripe';
const stripe = new Stripe(process.env.VITE_STRIPE_SECRET_KEY, {
  apiVersion: '2022-11-15',
});


export default {stripe}
