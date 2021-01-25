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

            $table->string('milk_amout')->nullable();
            $table->string('lactometer_reading')->nullable();
            $table->string('milk_taste')->nullable();
            $table->string('priority')->nullable();
            $table->string('shift')->nullable();
            $table->string('duedate')->nullable();
            $table->string('duetime')->nullable();
            $table->string('starttime')->nullable();
            $table->string('endtime')->nullable();
            $table->string('status')->nullable();

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
        Schema::dropIfExists('tasks');
    }
}
