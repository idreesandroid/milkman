<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'vendors_location',
        'status',
        'collector_id'
    ];

    public function vendors(){
    	return $this->belongsToMany(User::class, 'collection_vendor', 'collection_id', 'vendor_id');
    }
}
