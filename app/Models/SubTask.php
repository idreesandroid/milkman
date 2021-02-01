<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'task_id',
        'milkCollected',
        'status',
        'collectedTime'        
    ];

    public function taskAsSubTask()
    {
        return $this->belongsTo(TaskArea::class);
    }

    public function vendorAsTask()
    {
        return $this->belongsTo(User::class);
    }

}
