<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStock extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $fillable = ['product_id','batch_name','manufactured_date','expire_date','manufactured_quantity','stockInBatch','manager_id'];    
    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

     public function Manager()
    {
        return $this->belongsTo(User::class);
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
