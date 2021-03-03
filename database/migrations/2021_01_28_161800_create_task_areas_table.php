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
            $table->foreign('area_id')->references('id')->on('collections');
            $table->integer('collector_id')->unsigned();
            $table->foreign('collector_id')->references('id')->on('users');
            $table->enum('shift',['Morning','Evening']);
            $table->enum('assignType',['Permanent','Temporary'])->nullable();
            $table->enum('taskAreaStatus',['Active','inActive','Blocked'])->nullable();
            $table->date('assignFrom')->nullable();
            $table->date('assignTill')->nullable();
            $table->string('reason')->nullable();
            $table->string('oldTaskId')->nullable()->unsigned();
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
