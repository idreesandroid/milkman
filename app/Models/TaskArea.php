<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskArea extends Model
{
    use HasFactory;
    protected $fillable = [
        'area_id',
        'collector_id',
        'shift'
        
    ];

    public function areaAsTask()
    {
        return $this->belongsTo(Collection::class);
    }

    public function taskAssignTo()
    {
        return $this->belongsTo(User::class);
    }

    public function taskHasManySubTask()
    {
        return $this->hasMany(SubTask::class);
    }
}
