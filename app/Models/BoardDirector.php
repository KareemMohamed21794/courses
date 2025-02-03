<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BoardDirector extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['admin_id','first_name','father_name','grandfather_name','family_name','full_name','job','birth_date','birth_place','mission','mobile_number'];


     public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }

   
}
