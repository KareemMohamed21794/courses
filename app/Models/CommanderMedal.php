<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommanderMedal extends Model
{
    use HasFactory;
    protected $fillable = ['admin_id','document','year'];

     public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
