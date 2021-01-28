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
            $table->foreign('type_id')->references('id')->on('assets_types')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('collector_id')->unsigned()->nullable();
            $table->foreign('collector_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
