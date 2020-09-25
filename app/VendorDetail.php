<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vendor_Route;

class VendorDetail extends Model
{
    protected $fillable = ['vendor_id','route_id','decided_milkQuantity','decided_rate',];


    public function vendor()
    {
        return $this->belongsTo('App\User');
    }

    public function vendor_route()
    {
        return $this->hasMany(Vendor_Route::class);
    }
}
