<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    protected $fillable = ['state_name'];
    use HasFactory;

    public function city()
    {
      return  $this->hasMany(City::class);
    }
    public function userState()
    {
      return  $this->hasMany(User::class);
    }

}
