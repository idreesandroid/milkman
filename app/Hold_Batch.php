<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hold_Batch extends Model
{
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
