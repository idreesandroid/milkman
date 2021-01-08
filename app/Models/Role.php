<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name','slug'];
    
    public function users()
    { 
        return $this->belongsToMany(User::class)->withtimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withtimestamps();
    }

    public function allowTo($permission)
    {
        $this->permissions()->sync($permission, false);
    }    

    public function accRole()
    {
      return $this->hasOne(VendorDetail::class);
    }
}
