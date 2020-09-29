<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('user_cnic');
            $table->string('user_phone');          
            $table->string('user_address');

            $table->integer('user_state')->unsigned();
            $table->foreign('user_state')->references('id')->on('states');
            $table->integer('user_city')->unsigned();
            $table->foreign('user_city')->references('id')->on('cities');
         

            $table->datetime('created_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
