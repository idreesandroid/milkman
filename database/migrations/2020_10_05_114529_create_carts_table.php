<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->integer('invoice_id')->unsigned();
            $table->foreign('invoice_id')->references('id')->on('invoices');
            
            $table->integer('buyer_id')->unsigned();

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('seller_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('users');
            
            $table->integer('batch_id')->unsigned();
            $table->foreign('batch_id')->references('id')->on('product_stocks');

            $table->integer('product_quantity');
            $table->integer('product_rate');

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
        Schema::dropIfExists('carts');
    }
}
