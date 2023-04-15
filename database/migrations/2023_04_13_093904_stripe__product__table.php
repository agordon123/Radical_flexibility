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
        

            Schema::table('StripeProducts', function (Blueprint $table){
            $table->id();
            $table->string('price_id');
            $table->string('stripe_product_id');
            $table->string('product_name');
            $table->decimal('price',10,2)->nullable();
            $table->string('currency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};