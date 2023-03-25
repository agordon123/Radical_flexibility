<?php

use App\Models\Donor;
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


                Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->references('id')->on('donors')->onDelete('cascade');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country');
            $table->string('postal_code');
            $table->timestamps();
            });
                    Schema::create('orders',function(Blueprint $table){
            $table->id();
            $table->integer('order_number');
            $table->foreignIdFor(Donor::class,'donor_id');
            $table->foreignId('shipping_address_id')->references('id')->on('shipping_addresses');
            $table->decimal('subtotal',8,2,true);
            $table->decimal('total',8,2,true);
            $table->boolean('status');
            $table->decimal('shipping_cost',8,2,true);
            $table->string('order_status');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('donations');
    }
};