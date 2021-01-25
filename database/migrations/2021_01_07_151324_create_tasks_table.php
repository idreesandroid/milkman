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
            $table->string('milk_amout')->nullable()->default("null");
            $table->string('lactometer_reading')->nullable()->default("null");
            $table->string('milk_taste')->nullable()->default("null");
            $table->string('priority')->nullable()->default("null");
            $table->string('shift')->nullable()->default("null");
            $table->string('duedate')->nullable()->default("null");
            $table->string('duetime')->nullable()->default("null");
            $table->string('starttime')->nullable()->default("null");
            $table->string('endtime')->nullable()->default("null");
            $table->string('status')->nullable()->default("null");
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
