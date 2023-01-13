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
        Schema::create('hundred', function (Blueprint $table) {
            $table->id();
            $table->string('sitting_room')->nullable();
            $table->string('dinning_room')->nullable();
            $table->string('kitchen')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('bedroom')->nullable();
            $table->string('swimming_pool')->nullable();
            $table->string('lake')->nullable();
            $table->string('beach')->nullable();
            $table->string('ocean_view')->nullable();
            $table->string('balcony')->nullable();
            $table->string('parking')->nullable();
            $table->string('front')->nullable();
            $table->string('right')->nullable();
            $table->string('left')->nullable();
            $table->string('back')->nullable();
            $table->string('aerial')->nullable();
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('house_id');
            $table->foreign('user')->references('id')->on('dineusers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('hundred');
    }
};
