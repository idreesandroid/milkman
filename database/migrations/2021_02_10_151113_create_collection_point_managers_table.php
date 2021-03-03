<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionPointManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_point_managers', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');       
            $table->integer('collectionPointId')->unsigned()->nullable();
            $table->foreign('collectionPointId')->references('id')->on('milk_collection_points');
            $table->enum('managerStatus',['Active','inActive']);
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
        Schema::dropIfExists('collection_point_managers');
    }
}
