<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    use HasFactory;
    protected $table = 'setup';
    protected $fillable = ['dead_line','commander_medal_date','late_cost','secondary_registration_file','administrative_file','financial_file','board_director_meeting_file','commander_medal_file','achievement_study_requirement_file'];
}
