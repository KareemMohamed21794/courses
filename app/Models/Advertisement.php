<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Advertisement extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['admin_id','group_type','file','file_name','description'];

    
     public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
