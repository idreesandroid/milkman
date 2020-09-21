<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;
use App\State;
use App\City;

class State extends Model
{
    protected $fillable = ['name','country_id'];

    public function city()
    {
      return  $this->hasMany('App\city');
    }

    public function country()
    {
      return  $this->belongsTO('App\country');
    }
}
