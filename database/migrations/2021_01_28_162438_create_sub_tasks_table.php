<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_tasks', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->integer('vendor_id')->unsigned();
            $table->foreign('vendor_id')->references('id')->on('users');

            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('task_areas');

            $table->integer('milkCollected')->unsigned()->nullable();
            $table->double('fat', 8, 2)->nullable();
            $table->double('Lactose', 8, 2)->nullable();
            $table->double('Ash', 8, 2)->nullable();
            $table->double('totalProteins', 8, 2)->nullable();
            $table->double('totalSolid', 8, 2)->nullable();
            $table->string('qualityPic')->nullable();
            $table->string('taskShift')->nullable();
            $table->integer('AssignTo')->nullable();
            $table->date('collection_date');
            $table->enum('status',['initialize','inProcess','Expired','Submitted','Rejected','Collected']);
            $table->dateTime('collectedTime')->nullable();
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
        Schema::dropIfExists('sub_tasks');
    }
}
