<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['total_price','total_amount'];    

    public function invoice_bill()
    {
        return $this->hasMany(Cart::class);
    }


    public function buyer_invoice()
    {
        return $this->belongsTo(User::class);
    }

}
