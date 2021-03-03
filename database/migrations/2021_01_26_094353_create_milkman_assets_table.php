<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMilkmanAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milkman_assets', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('assets_types');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('assignedPoint')->unsigned()->nullable();
            $table->foreign('assignedPoint')->references('id')->on('milk_collection_points');
            $table->string('assetName');
            $table->string('assetCode');
            $table->integer('assetCapacity');
            $table->softDeletes();
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
        Schema::dropIfExists('milkman_assets');
    }
}
