<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_cnic',
        'user_phone',
        'state_id',
        'city_id',
        'user_address',
        'filenames'
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
      return $this->belongsToMany(Role::class)->withtimestamps();
    }

    public function assignRole($role)
    {  
      $this->roles()->sync($role, false);
    }

    public function userPermissions()
    { 
      return $this->roles->map->permissions->flatten()->pluck('name')->unique();    
    }

    public function vendorDetail()
    {
      return $this->hasOne(VendorDetail::class);
    }

    public function distributorCompany()
    {
      return $this->hasOne(Distributor::class);
    }

    public function bankDetail()
    {
      return $this->hasOne(bankDetail::class);
    }

    public function state()
    {
      return  $this->belongsTo(State::class);
    }

    public function city()
    {
      return  $this->belongsTo(City::class);
    }    

    public function invoice()
    {
      return $this->hasMany(Invoice::class);
    }

}
