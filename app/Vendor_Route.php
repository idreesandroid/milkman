<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\VendorDetail;
class Vendor_Route extends Model
{   
    use SoftDeletes;
    protected $fillable = ['route_name'];
    protected $dates = ['deleted_at'];
    public function vendorDetail()
    {
        return $this->hasMany(VendorDetail::class);
    }
}
