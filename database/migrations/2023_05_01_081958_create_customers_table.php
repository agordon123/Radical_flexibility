<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('stripe_customer_id')->unique();
            $table->string('email');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('order_id')->references('id')->on('orders')->cascadeOnDelete();
            $table->foreignId('checkout_session_id')->references('checkout_session_id')->on('checkout_sessions');
            $table->foreignId('address_id')->references('id')->on('addresses')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
