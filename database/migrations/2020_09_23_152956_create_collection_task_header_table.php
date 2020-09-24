<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionTaskHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Collection_task_header', function (Blueprint $table) {
            $table->id();
            $table->integer('collector_id');
            $table->dateTime('task_date');
            $table->string('task_time');
            $table->dateTime('created_time');
            $table->integer('created_by');
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
        Schema::dropIfExists('Collection_task_header');
    }
}
