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
        Schema::create('booking_info', function (Blueprint $table) {
            $table->id();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('number_of_guests')->nullable();
            $table->string('number_of_days')->nullable();
            $table->string('number_of_hours')->nullable();
            $table->string('total_price')->nullable();
            $table->string('paid')->nullable();
            $table->string('mpesa_message')->nullable();
            $table->string('bank_message')->nullable();
            $table->string('booking_phone')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('house_id');
            $table->unsignedBigInteger('pay_id');
            $table->foreign('user_id')->references('id')->on('dineusers')->onUpdate('cascade');
            $table->foreign('house_id')->references('id')->on('house_details')->onUpdate('cascade');
            $table->foreign('pay_id')->references('id')->on('lnmo_api_response')->onUpdate('cascade');
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
        Schema::dropIfExists('booking_info');
    }
};
