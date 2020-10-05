<?php

namespace App;
use App\Role;
use App\State;
use App\City;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = ['name', 'email', 'password','user_cnic','user_phone','user_state','user_city','user_address',];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_role()
    {
      return  $this->belongsTOMany('App\Role');
    }

    public function vendor_detail()
    {
        return $this->hasOne('App\VendorDetail');
    }


    public function state()
    {
      return  $this->belongsTo('App\State');
    }

    public function city()
    {
      return  $this->belongsTo(City::class);
    }

    // public function get_route()
    // {
    //     return $this->hasManyThrough('App\Vendor_Route', 'App\VendorDetail');
    // }

    public function seller()
    {
        return $this->hasMany(Cart::class);
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}
