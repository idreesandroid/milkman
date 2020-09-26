<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
           
            $table->string('batch_name')->unique();
            $table->date('manufactured_date');
            $table->date('expire_date');
            $table->datetime('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('manufactured_quantity');

           // $table->integer('manager_id')->unsigned();
           // $table->foreign('manager_id')->references('id')->on('users');


           
           $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_stocks');
    }
}
