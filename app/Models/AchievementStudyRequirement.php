<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchievementStudyRequirement extends Model
{
    use HasFactory;
    protected $fillable = ['admin_id','document'];
    protected $table = 'achievements_study_requirements';

     public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
