<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorDetailsTable extends Migration
{
   
    public function up()
    {
        Schema::create('vendor_details', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('vendor_id')->unsigned();
            $table->foreign('vendor_id')->references('id')->on('users');
            $table->integer('route_id')->unsigned();
            $table->foreign('route_id')->references('id')->on('vendor__routes');
            $table->integer('decided_milkQuantity');
            $table->integer('decided_rate');
            $table->datetime('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('vendor_details');
    }
}
