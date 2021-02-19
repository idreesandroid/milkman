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
            $table->foreign('vendor_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('task_areas')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('milkCollected')->nullable();

            $table->float('fat')->nullable();
            $table->float('Lactose')->nullable();
            $table->float('Ash')->nullable();
            $table->float('totalProteins')->nullable();
            $table->float('totalSolid')->nullable();
            $table->string('qualityPic')->nullable();
            $table->float('AssignTo')->nullable();
            $table->date('collection_date');
            $table->enum('status',['initialize','inProcess','Complete','Expired','Submitted','Rejected']);
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
