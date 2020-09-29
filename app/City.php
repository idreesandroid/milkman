<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\State;
use App\City;
class City extends Model
{
    
    protected $fillable = ['city_name','state_id'];



    public function state()
    {
      return  $this->belongsTO('App\State');
    }

    public function userCity()
    {
      return  $this->hasMany('App\User');
    }
}
