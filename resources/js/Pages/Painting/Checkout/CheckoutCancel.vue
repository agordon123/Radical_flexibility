<template>
    <div class="stripe-checkout-cancel">
      <h2>Payment Canceled</h2>
      <p>Your payment was canceled. If you want to try again, please click the button below.</p>
      <button @click="returnToMainPage">Return to Main Page</button>
    </div>
  </template>

  <script setup>
 import { router } from '@inertiajs/vue3';

 const    returnToMainPage =()=> {

        router.visit('/');
      }

  </script>

  <style scoped>
  .stripe-checkout-cancel {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
  }

  h2 {
    color: red;
  }

  button {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-radius: 4px;
    color: #495057;
    cursor: pointer;
    font-size: 1rem;
    padding: 0.5rem 1rem;
    margin-top: 1rem;
    transition: background-color 0.2s, color 0.2s;
  }

  button:hover {
    background-color: #495057;
    color: #f8f9fa;
  }
  </style>
