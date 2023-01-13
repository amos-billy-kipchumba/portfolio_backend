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
        Schema::create('house_details', function (Blueprint $table) {
            $table->id();
            $table->string('cover')->nullable();
            $table->string('title');
            $table->string('description');
            $table->string('location');
            $table->string('price');
            $table->string('house_type');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('dineusers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('house_details');
    }
};
