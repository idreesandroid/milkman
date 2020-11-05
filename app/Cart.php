<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['product_quantity','product_rate','sub_total','delivery_due_date'];   
    
    public function cart_invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class);
    }

    public function batch()
    {
        return $this->belongsTo(ProductStock::class);
    }

    public function setCartId()
    {
        return $this->hasMany(Hold_Batch::class);
    }

}
