<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['product_quantity','product_rate','sub_total','delivery_due_date','invoice_id'];   
    
    public function cart_invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }   

    public function batch()
    {
        return $this->belongsTo(ProductStock::class);
    }

    public function setCartId()
    {
        return $this->hasMany(holdBatch::class);
    }
}
