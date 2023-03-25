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

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->references('id')->on('donors')->onDelete('cascade');
            $table->foreignId('stripe_charge_id')->references('id')->on('payments')->nullable();
            $table->decimal('amount', 10, 2, true);
            $table->foreignId('currency_id')->references('id')->on('currency')->onDelete('cascade');
            $table->string('payment_intent_id');
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};