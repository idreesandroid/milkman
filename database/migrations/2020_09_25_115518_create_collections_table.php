<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->text('vendors_location');
            $table->string('status');
            $table->string('collector_id');
            $table->tinyInteger('AFM')->default(0);
            $table->tinyInteger('AFE')->default(0);
            $table->enum('areaStatus',['Active','inActive','Block']);  //CHANGE BY ASIM
           
            $table->integer('collectionPoint_id')->unsigned()->nullable();
            $table->foreign('collectionPoint_id')->references('id')->on('collections');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
}
