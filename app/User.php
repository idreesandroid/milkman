<?php

namespace App;
use App\User_Role;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    
    
    protected $fillable = ['name', 'email', 'password','user_cnic','user_phone','user_state','user_city','user_address'];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_role()
    {
      return  $this->belongsTO('App\User_Role');
    }

    public function vendorDetail()
    {
        return $this->hasOne('App\VendorDetail');
    }
}
