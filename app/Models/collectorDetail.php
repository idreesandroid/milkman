<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class collectorDetail extends Model
{
    use HasFactory;

    public function collectorPersonal()
    {
        return $this->belongsTo(User::class);
    }

    public function collectorCollectionPoint()
    {
        return $this->belongsTo(milkCollectionPoint::class);
    }

}
