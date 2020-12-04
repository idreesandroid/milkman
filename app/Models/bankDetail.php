<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bankDetail extends Model
{
    use HasFactory;

    protected $fillable = ['bank_name','branch_name','branch_code','acc_no','acc_title'];

    public function userPersonal()
    {
        return $this->belongsTo(User::class);
    }

}
