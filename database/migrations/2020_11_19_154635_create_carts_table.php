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
            //$table->foreign('invoice_id')->references('id')->on('invoices');
            $table->integer('product_id')->unsigned();
            //$table->foreign('product_id')->references('id')->on('products');
            $table->integer('product_quantity');
            $table->string('product_rate');
            $table->enum('cart_flag',['In_Process','Delivered','Reserve']);
            $table->string('sub_total');
            $table->date('delivery_due_date');
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
