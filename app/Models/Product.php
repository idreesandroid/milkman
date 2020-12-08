<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $fillable = ['product_name','product_size','product_price','unit','product_description','ctn_value','product_nick','filenames'];    

    protected $dates = ['deleted_at'];

    public function product_stock()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function productCart()
    {
        return $this->hasMany(Cart::class);
    }
}
