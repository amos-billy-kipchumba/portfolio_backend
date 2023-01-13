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
        Schema::create('nearby_services', function (Blueprint $table) {
            $table->id();
            $table->string('butchery')->nullable();
            $table->string('butchery_distance')->nullable();
            $table->string('mini_mart')->nullable();
            $table->string('mini_mart_distance')->nullable();
            $table->string('supermarket')->nullable();
            $table->string('supermarket_distance')->nullable();
            $table->string('grocery_store')->nullable();
            $table->string('grocery_store_distance')->nullable();
            $table->string('spice_mart')->nullable();
            $table->string('spice_mart_distance')->nullable();

            $table->string('maasai_market')->nullable();
            $table->string('maasai_market_distance')->nullable();
            $table->string('cake_baker')->nullable();
            $table->string('cake_baker_distance')->nullable();
            $table->string('tent_hire')->nullable();
            $table->string('tent_hire_distance')->nullable();
            $table->string('event_planner')->nullable();
            $table->string('event_planner_distance')->nullable();
            $table->string('organic_farm')->nullable();
            $table->string('organic_farm_distance')->nullable();
            $table->string('ranch')->nullable();
            $table->string('ranch_distance')->nullable();
            $table->string('aqua_farm')->nullable();
            $table->string('aqua_farm_distance')->nullable();
            $table->string('chemist')->nullable();
            $table->string('chemist_distance')->nullable();
            $table->string('bookshop')->nullable();
            $table->string('bookshop_distance')->nullable();
            $table->string('library')->nullable();
            $table->string('library_distance')->nullable();
            $table->string('chef')->nullable();
            $table->string('chef_distance')->nullable();
            $table->string('pizza_inn')->nullable();
            $table->string('pizza_inn_distance')->nullable();
            $table->string('creamy_inn')->nullable();
            $table->string('creamy_inn_distance')->nullable();
            $table->string('kfc')->nullable();
            $table->string('kfc_distance')->nullable();
            $table->string('petrol_station')->nullable();
            $table->string('petrol_station_distance')->nullable();
            $table->string('java')->nullable();
            $table->string('java_distance')->nullable();
            $table->string('hotel')->nullable();
            $table->string('hotel_distance')->nullable();
            $table->string('salon')->nullable();
            $table->string('salon_distance')->nullable();
            $table->string('barber')->nullable();
            $table->string('barber_distance')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('house_id');
            $table->foreign('user_id')->references('id')->on('dineusers')->onUpdate('cascade');
            $table->foreign('house_id')->references('id')->on('house_details')->onUpdate('cascade');
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
        Schema::dropIfExists('nearby_services');
    }
};
