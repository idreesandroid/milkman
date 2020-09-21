<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryStateCityTables extends Migration
{
   
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');           
            $table->timestamps();
        });
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('states');            
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('countries');
        Schema::dropIfExists('states');
        Schema::dropIfExists('cities');
        
    }
}
