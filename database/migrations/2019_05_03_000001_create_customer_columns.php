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
        Schema::table('users', function (Blueprint $table) {
            $table->string('stripe_id')->nullable()->index();
            $table->string('pm_type')->nullable();
            $table->string('pm_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();
        });

        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('stripe_id')->nullable()->index();
            $table->string('payment_intent_id');
            $table->string('pm_type')->nullable();
            $table->string('pm_last_four', 4)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'stripe_id',
                'pm_type',
                'pm_last_four',
                'trial_ends_at',
            ]);
        });
    }
};