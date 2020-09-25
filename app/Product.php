<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name','product_size','product_price','unit'];    

    public function product_stock()
    {
        return $this->hasMany(ProductStock::class);
    }
  
}
