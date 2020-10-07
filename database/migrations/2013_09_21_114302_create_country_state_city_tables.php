<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryStateCityTables extends Migration
{
   
    public function up()
    {
      
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('state_name');           
            $table->timestamps();
        });
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('city_name');
            $table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('states');            
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('states');
        Schema::dropIfExists('cities');
        
    }
}