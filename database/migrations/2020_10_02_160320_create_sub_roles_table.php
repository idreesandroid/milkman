<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_roles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('role_id') ->references('role_id')->on('roles');
            $table->string('sub_role_title');
            $table->string('sub_role_status')->default(DB::raw(0));
           
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
        Schema::dropIfExists('sub_roles');
    }
}
