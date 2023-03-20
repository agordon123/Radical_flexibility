<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('donor_artwork', function (Blueprint $table) {
            $table->id();
            $table->unsignedDecimal('amount');
            $table->boolean('receive_artwork')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('donor_artworks');
    }
};