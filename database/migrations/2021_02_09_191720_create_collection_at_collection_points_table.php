<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionAtCollectionPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_at_collection_points', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->integer('collectionArea_id')->unsigned();
            $table->foreign('collectionArea_id')->references('id')->on('collections');

            $table->integer('taskAreaId')->unsigned();
            $table->foreign('taskAreaId')->references('id')->on('task_areas');

            $table->float('areaCollection')->unsigned();
            $table->date('collectionDate');

            $table->float('averagePurity');

            $table->integer('receivedBy')->unsigned();
            $table->foreign('receivedBy')->references('id')->on('users');


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
        Schema::dropIfExists('collection_at_collection_points');
    }
}
