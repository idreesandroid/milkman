<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

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
