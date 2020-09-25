<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class User_Role extends Model
{

    protected $fillable = ['role_title'];

    public function user()
    {
      return  $this->hasMany('App\User');
    }
   
}
