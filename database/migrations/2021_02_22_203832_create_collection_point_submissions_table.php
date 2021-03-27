<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionPointSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_point_submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('area_Id')->nullable();
            //$table->foreign('area_Id')->references('id')->on('collections');

            $table->integer('collectionPoint_id')->unsigned()->nullable();
            //$table->foreign('collectionPoint_id')->references('id')->on('milk_collection_points');

            $table->integer('collector_id');
            //$table->foreign('collector_id')->references('user_id')->on('collector_details');
           
            $table->enum('collectionShift',['Evening','Morning'])->nullable();
            $table->string('milkCollected');
            $table->double('averageFat', 8, 2)->nullable();
            $table->double('averageAsh', 8, 2)->nullable();
            $table->double('averageProteins', 8, 2)->nullable();
            $table->double('averageSolids', 8, 2)->nullable();
            $table->double('averageLactose', 8, 2)->nullable();
            $table->string('averageQuality_SS')->nullable();
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
        Schema::dropIfExists('collection_point_submissions');
    }
}
