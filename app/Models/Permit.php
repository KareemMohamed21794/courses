<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Permit extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['admin_id','activity_name','permit_number','nature_activity','activity_description','place_activity','activity_history','number_days','alwahda','alwahda_description','activity_leader','number_leader'];


     public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
