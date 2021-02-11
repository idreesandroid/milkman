<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class milkCollectionPoint extends Model
{
    use HasFactory;
    protected $fillable = ['pointName','pointAddress'];    

    public function relativeArea()
    {
        return $this->hasMany(Collection::class);
    }

    public function relativeCollector()
    {
        return $this->hasMany(collectorDetail::class);
    }

        public function relevantManager()
    {
        return $this->hasMany(collectionPointManager::class);
    }

}
