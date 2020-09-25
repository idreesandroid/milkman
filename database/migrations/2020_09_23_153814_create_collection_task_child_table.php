<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionTaskChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Collection_task_child', function (Blueprint $table) {
            $table->id();
            $table->integer('task_id');
            $table->integer('collector_id');
            $table->integer('vendor_id');
            $table->integer('received_qty');
            $table->integer('milk_quality');
            $table->dateTime('received_date_time');

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
        Schema::dropIfExists('Collection_task_child');
    }
}
