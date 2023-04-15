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
        Schema::table('paintings', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();

            $table->foreign('product_id')
                ->references('id')
                ->on('stripeproducts')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paintings', function (Blueprint $table) {
            //
        });
    }
};