<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMilkProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milk_processes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('alotment_code')->unique();
            $table->string('processDescription');
            $table->integer('milkQuantity')->unsigned();
            $table->integer('processManager_id')->unsigned()->nullable();
            $table->foreign('processManager_id')->references('id')->on('users');
            $table->integer('milkBankManager_id')->unsigned()->nullable();
            $table->integer('milkBankId')->unsigned();
            $table->foreign('milkBankId')->references('id')->on('milk_banks');
            $table->enum('milkRequestStatus',['Requested','Granted','Rejected']);
            $table->string('rejectionReason')->nullable();
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
        Schema::dropIfExists('milk_processes');
    }
}
