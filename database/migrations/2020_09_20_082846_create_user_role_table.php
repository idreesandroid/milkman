<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoleTable extends Migration
{
    
    public function up()
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->id();
            $table->string('role_title');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('user_role');
    }
}
