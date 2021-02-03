<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendorDetail extends Model
{
    use HasFactory;

    protected $fillable = ['filenames','decided_milkQuantity','morning_decided_milkQuantity','evening_decided_milkQuantity','decided_rate','morningTime','eveningTime','collection_id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function userPersonal()
    {
        return $this->belongsTo(User::class);
    }

    public function vendorArea()
    {
        return $this->belongsTo(Collection::class);
    }

    public function vendorSubTask()
    {
        return $this->hasMany(SubTask::class);
    }

}
