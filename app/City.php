<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\State;
use App\City;
class City extends Model
{
    
    protected $fillable = ['name','state_id'];



    public function state()
    {
      return  $this->belongsTO('App\State');
    }
}
