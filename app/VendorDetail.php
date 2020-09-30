<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vendor_Route;
use App\User;

class VendorDetail extends Model
{
   
    
    protected $fillable = ['route_id','decided_milkQuantity','decided_rate','bank_name','branch_name','branch_code','acc_no','acc_title','vendor_location',];


 

    
    
   // protected $fillable = ['name', 'email', 'password','user_cnic','user_phone','user_state','user_city','user_address'];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function userPersonal()
    {
        return $this->belongsTo('App\User');
    }

    public function vendor_route()
    {
        return $this->belongsTo(Vendor_Route::class);
    }

    // public function vendorState()
    // {
    //     return $this->hasManyThrough('App\VendorDetail', 'App\User');
    // }
}
