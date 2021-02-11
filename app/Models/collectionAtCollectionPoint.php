<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class collectionAtCollectionPoint extends Model
{
    use HasFactory;
    protected $fillable = ['milkCollectionPoint_id','taskAreaId','areaCollection','collectionDate','averagePurity','receivedBy'];

    public function receiver()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedArea()
    {
        return $this->belongsTo(TaskArea::class);
    }

    public function belongsToArea()
    {
        return $this->belongsTo(Collection::class);
    }


}
