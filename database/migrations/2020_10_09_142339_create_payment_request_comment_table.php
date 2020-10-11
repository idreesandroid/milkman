<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentRequestCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_request_comment', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('request_id');
            $table->string('commnet_text');
            $table->integer('mark_to_role');
            $table->integer('mark_from_role');
            $table->integer('entry_by');
            $table->datetime('entry_date')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('payment_request_comment');
    }
}
