// See your keys here: https://dashboard.stripe.com/apikeys
import Stripe from 'stripe';
import {StripeCheckout, StripeElementsPlugin,StripePlugin  } from '@vue-stripe/vue-stripe'
const options = {
    pk:process.env.VITE_STRIPE_KEY
}
const plugin = StripePlugin({PublicKeyCredential:process.env.STRIPE_KEY})
const elements = StripeElementsPlugin({PublicKeyCredential})

export default {stripe}
