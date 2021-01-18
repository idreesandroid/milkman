<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->unsigned();
            $table->foreign('vendor_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('collector_id')->unsigned();
            $table->foreign('collector_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('collection_id')->unsigned();
            $table->foreign('collection_id')->references('id')->on('collections')->onUpdate('cascade')->onDelete('cascade');
            $table->string('milk_amout');
            $table->string('lactometer_reading');
            $table->string('milk_taste');
            $table->string('priority');
            $table->string('shift');
            $table->string('duedate');
            $table->string('duetime');
            $table->string('starttime');
            $table->string('endtime');
            $table->string('status');
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
        Schema::dropIfExists('tasks');
    }
}
