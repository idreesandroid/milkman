<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('product_name')->unique()->unique();
            $table->string('product_nick');
            $table->string('product_description');
            $table->string('product_size');
            $table->enum('unit',['ml','ltr','gm','kg']);
            $table->string('product_price');
            $table->integer('ctn_value');
            $table->string('filenames');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
