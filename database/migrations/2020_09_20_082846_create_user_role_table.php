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
            $table->datetime('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('created_by');
            $table->datetime('updated_date');
            $table->string('update_by');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('user_role');
    }
}
