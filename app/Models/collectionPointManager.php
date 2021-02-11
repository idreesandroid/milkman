<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class collectionPointManager extends Model
{
    use HasFactory;

    public function collection_Manager()
    {
      return $this->belongsTo(User::class);
    }

    public function relevant_collection()
    {
      return  $this->belongsTo(milkCollectionPoint::class);
    }

}
