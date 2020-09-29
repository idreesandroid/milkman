<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\VendorDetail;
class Vendor_Route extends Model
{
    protected $fillable = ['route_name'];

    public function vendorDetail()
    {
        return $this->hasMany(VendorDetail::class);
    }
}
