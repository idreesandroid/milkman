<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vendor_Route;
use App\User;

class VendorDetail extends Model
{
   
    
    protected $fillable = ['route_id','filenames','decided_milkQuantity','decided_rate','bank_name','branch_name','branch_code','acc_no','acc_title','vendor_location',];

   
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
