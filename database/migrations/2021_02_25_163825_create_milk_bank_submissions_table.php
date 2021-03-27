<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMilkBankSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milk_bank_submissions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('milkBank_id')->unsigned();
            //$table->foreign('milkBank_id')->references('id')->on('milk_banks');
            $table->integer('collectionPoint_id')->unsigned();
            //$table->foreign('collectionPoint_id')->references('id')->on('milk_collection_points');
            $table->integer('collectionManager_id')->unsigned();
            //$table->foreign('collectionManager_id')->references('id')->on('collection_point_managers');
            $table->integer('milkCollected')->unsigned()->nullable();
           
            $table->double('averageFat', 8, 2)->nullable();
            $table->double('averageAsh', 8, 2)->nullable();
            $table->double('averageProteins', 8, 2)->nullable();
            $table->double('averageLactose', 8, 2)->nullable();
            $table->double('averageSolids', 8, 2)->nullable();
            $table->string('Quality_SS')->nullable();
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
        Schema::dropIfExists('milk_bank_submissions');
    }
}
