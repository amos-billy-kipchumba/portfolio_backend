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
        Schema::create('mpesa_transactions', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->tinyInteger('status')->default(0);
            $table->string('TransactionType', 10);
            $table->string('TransID', 10)->unique('TransID');
            $table->string('TransTime', 14);
            $table->double('TransAmount');
            $table->string('BusinessShortCode', 6);
            $table->string('BillRefNumber', 200);
            $table->string('InvoiceNumber', 6);
            $table->string('OrgAccountBalance', 100);
            $table->string('ThirdPartyTransID', 10);
            $table->string('MSISDN', 14);
            $table->string('FirstName', 10)->nullable();
            $table->string('MiddleName', 10)->nullable();
            $table->string('LastName', 10)->nullable();
            $table->dateTime('lastUpdate')->useCurrent();
            $table->unsignedBigInteger('user_id')->nullable()->index('mpesa_transactions_user_id_foreign');
            $table->unsignedBigInteger('house_id')->nullable()->index('mpesa_transactions_house_id_foreign');
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
        Schema::dropIfExists('mpesa_transactions');
    }
};
