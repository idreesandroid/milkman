<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\State;
use App\City;

class State extends Model
{
    protected $fillable = ['name'];

    public function city()
    {
      return  $this->hasMany('App\city');
    }

   
}
