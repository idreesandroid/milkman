<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_request', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('vendor_id');
            $table->integer('claim_amount');
            $table->integer('mark_to_role');
            $table->integer('mark_from_role'); 
            $table->datetime('entry_date_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('flag')->default(0); 
            $table->timestamps();
            // ->default(0); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_request');
    }
}
