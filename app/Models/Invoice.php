<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    protected $fillable = ['invoice_number','total_amount','flag'];    

    public function invoice_bill()
    {
        return $this->hasMany(Cart::class);
    }


    public function buyer()
    {
        return $this->belongsTo(User::class);
    }
}
