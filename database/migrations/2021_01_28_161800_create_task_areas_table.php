<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_areas', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('collections')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('collector_id')->unsigned();
            $table->foreign('collector_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('shift',['Morning','Evening']);

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
        Schema::dropIfExists('task_areas');
    }
}
