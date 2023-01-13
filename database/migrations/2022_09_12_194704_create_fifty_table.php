<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fifty', function (Blueprint $table) {
            $table->id();
            $table->string('max_no_of_guests');
            $table->string('number_of_bedrooms');
            $table->string('number_of_beds');
            $table->string('number_of_bathtubs');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('house_id');
            $table->foreign('user_id')->references('id')->on('dineusers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('house_id')->references('id')->on('house_details')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fifty');
    }
};
