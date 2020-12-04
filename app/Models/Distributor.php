<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','companyName','companyOwner','companyContact','companyAddress','companyNTN','filenames','companyArea'];

    public function distributorCompany()
    {
        return $this->belongsTo(User::class);
    }
}
