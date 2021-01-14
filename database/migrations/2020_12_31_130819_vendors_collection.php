<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VendorsCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_vendor', function (Blueprint $table) {

            $table->increments('id')->unsigned();
            $table->integer('collection_id')->unsigned();
            $table->foreign('collection_id')->references('id')->on('collections');
            $table->integer('vendor_id')->unsigned();
            $table->foreign('vendor_id')->references('id')->on('users');
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
        //
    }
}