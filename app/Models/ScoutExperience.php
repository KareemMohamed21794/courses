<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ScoutExperience extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['group_leader_id','place','mission','date_from','date_to','reason_leave'];
}
