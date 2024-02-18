<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AdvertisementParent extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['admin_id','group_type','file','file_name','description'];

    
     public function Advertisements()
    {
        return $this->hasMany(Advertisement::class,'parent_id');
    }
}
