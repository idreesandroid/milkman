<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionVendor extends Model
{
    use HasFactory;

    protected $table = 'collection_vendor';

    protected $fillable = [
        'collection_id',
        'vendor_id'
    ];
}
