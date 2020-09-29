<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Role extends Model
{
  protected $fillable = ['role_title'];
    public function user()
    {
      return  $this->belongsTOMany('App\User');
    }
}
