<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collector_details', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
           
            $table->enum('collectorMorStatus',['Free','Have Task']);
            $table->enum('collectorEveStatus',['Free','Have Task']);
            $table->integer('collectorCapacity')->nullable()->default(0);

            $table->integer('collectionPoint_id')->unsigned();
            $table->foreign('collectionPoint_id')->references('id')->on('milk_collection_points');
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
        Schema::dropIfExists('collector_details');
    }
}
