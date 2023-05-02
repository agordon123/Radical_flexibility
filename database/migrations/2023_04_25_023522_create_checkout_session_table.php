<?php

use App\Enums\PaymentStatus;
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
        Schema::create('checkout_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('checkout_session_id')->unique();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->json('metadata');
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
            $table->enum('payment_status',[PaymentStatus::Paid,PaymentStatus::Pending,PaymentStatus::Failed]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout_sessions');
    }
};
