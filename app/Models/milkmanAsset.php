<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class milkmanAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'user_id',
        'assetCode',
        'assetName',
        'assetCapacity'  
    ];
    protected $dates = ['deleted_at'];

    public function assetType()
    {
      return  $this->belongsTo(assetsType::class);
    }

    public function assetAssignTo()
    {
      return  $this->belongsTo(User::class);
    }
}
