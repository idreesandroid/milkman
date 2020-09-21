<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;
use App\State;
class Country extends Model
{
    protected $fillable = ['name'];

    public function state()
    {
      return  $this->hasMany('App\State');
    }
}
