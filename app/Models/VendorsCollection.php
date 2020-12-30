<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorsCollection extends Model
{
    use HasFactory;

    protected $table = 'vendors_collection';

    protected $fillable = [
        'collection_id',
        'vendor_id'
    ];
}
