<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tasks extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['vendor_id','collector_id','collection_id','milk_amout','lactometer_reading','milk_taste','priority','shift','duedate','duetime','starttime','endtime','status'];  
    

    
}
