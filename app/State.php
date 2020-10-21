<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\State;
use App\City;

class State extends Model
{
    protected $fillable = ['state_name'];

    public function city()
    {
      return  $this->hasMany('App\city');
    }
    public function userState()
    {
      return  $this->hasMany('App\User');
    }

   
   
}
