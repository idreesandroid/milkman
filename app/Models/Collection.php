<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Collection extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

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
