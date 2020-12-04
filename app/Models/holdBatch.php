<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class holdBatch extends Model
{
    use HasFactory;
 
    protected $table = "hold__batches";

    protected $fillable = ['batch_id','cart_id','select_qty','hb_flag'];  
    
    public function getBatch()
    {
        return $this->belongsTo(ProductStock::class);
    }

    public function getCartId()
    {
        return $this->belongsTo(ProductStock::class);
    }
}
