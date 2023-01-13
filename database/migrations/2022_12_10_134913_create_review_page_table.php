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
        Schema::create('review_page', function (Blueprint $table) {
            $table->id();

            $table->string('review_rating')->nullable();
            $table->string('review_comment')->nullable();
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
        Schema::dropIfExists('review_page');
    }
};
