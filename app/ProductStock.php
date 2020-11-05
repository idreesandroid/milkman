<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductStock extends Model
{
    use SoftDeletes;
    protected $fillable = ['product_id','batch_name','manufactured_date','expire_date','manufactured_quantity'];    
    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sell_stock()
    {
        return $this->hasMany(Cart::class);
    }

    public function setBatch()
    {
        return $this->hasMany(Hold_Batch::class);
    }
}
