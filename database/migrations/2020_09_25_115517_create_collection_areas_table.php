<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_areas', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('areaTitle');
            $table->string('areaDimension');
            $table->enum('areaStatus',['Active','inActive','Block']);

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
        Schema::dropIfExists('collection_areas');
    }
}
