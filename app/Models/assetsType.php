<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class assetsType extends Model
{
    use HasFactory;

    protected $fillable = [
        'typeName',
        'assetUnit',
        'description' 
    ];
    protected $dates = ['deleted_at'];

    public function asset()
    {
        return $this->hasMany(milkmanAsset::class);
    }
}
