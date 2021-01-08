<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','role_id','userAccount','balance'];

    public function User_acc()
    {
        return $this->belongsTo(User::class);
    }

    public function accHasRole()
    {
        return $this->belongsTo(Role::class);
    }

    public function accHasTransaction()
    {
      return $this->hasMany(UserTransaction::class);
    }
}
