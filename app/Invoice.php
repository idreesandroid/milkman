<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['buyer_id','invoice_number','total_amount','flag'];    

    public function invoice_bill()
    {
        return $this->hasMany(Cart::class);
    }


    public function buyer()
    {
        return $this->belongsTo(User::class);
    }

}
