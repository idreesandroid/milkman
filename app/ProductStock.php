<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{

    protected $fillable = ['product_id','batch_name','manufactured_date','expire_date','manufactured_quantity'];    


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
