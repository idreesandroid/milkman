<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hold__batches', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            
            $table->integer('batch_id')->unsigned();
            //$table->foreign('batch_id')->references('id')->on('product_stocks');
            $table->integer('cart_id')->unsigned();
            //$table->foreign('cart_id')->references('id')->on('carts');
            $table->integer('select_qty');
            $table->boolean('hb_flag')->default(0);


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
        Schema::dropIfExists('hold__batches');
    }
}
