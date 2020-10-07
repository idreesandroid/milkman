<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{

    
    use SoftDeletes;
    protected $fillable = ['product_name','product_size','product_price','unit','product_description','ctn_value','product_nick'];    

    protected $dates = ['deleted_at'];


    public function product_stock()
    {
        return $this->hasMany(ProductStock::class);
    }


    public function product_cart()
    {
        return $this->hasMany(Cart::class);
    }
}
