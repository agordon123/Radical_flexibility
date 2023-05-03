<?php

use App\Models\Order;
use App\Models\Customer;
use App\Enums\PaymentStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->foreignIdFor(Customer::class,'customer_id')->nullable();
            $table->json('metadata')->nullable();
            $table->foreignIdFor(Order::class,'order_id')->nullable();
            $table->foreignIdFor(Payment::class,'payment_intent_id')->nullable();
            $table->enum('payment_status',[PaymentStatus::Pending,PaymentStatus::Paid,PaymentStatus::Failed])->default(PaymentStatus::Pending);
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
