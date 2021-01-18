<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('invoice_number')->nullable();
            
            $table->integer('buyer_id')->unsigned();
            $table->foreign('buyer_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');


            $table->integer('seller_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('total_amount')->default(0);
            $table->integer('Remains')->default(0);
            $table->enum('flag',['Reserve','Payment_Pending','Sold','On_Hold','In_Process','Partial Paid','Paid']);
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
        Schema::dropIfExists('invoices');
    }
}
