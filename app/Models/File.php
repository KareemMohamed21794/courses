<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class File extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['admin_id','secondary_registration','administrative_financial1','administrative_financial2','board_director_meetings','type','year'];
}
