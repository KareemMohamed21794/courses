<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','user_type','action','action_type','table_name','table_id'];

    public function Admin()
    {
       
        return $this->belongsTo(Admin::class, 'user_id', 'id');
    }
}
