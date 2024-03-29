<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorDetailsTable extends Migration
{
   
    public function up()
    {
        Schema::create('vendor_details', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            //$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('filenames')->nullable();
            $table->integer('decided_milkQuantity');
            $table->integer('morning_decided_milkQuantity');
            $table->integer('evening_decided_milkQuantity');
            $table->integer('decided_rate');
            $table->string('morningTime');
            $table->string('eveningTime');

            $table->integer('collection_id')->unsigned()->nullable();
            //$table->foreign('collection_id')->references('id')->on('collections')->onUpdate('cascade')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('vendor_details');
    }
}
