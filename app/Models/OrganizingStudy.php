<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OrganizingStudy extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['admin_id','support_group','study_place','study_location','practical_place','practical_location','proposed_time_study','connected_from','connected_to','type_qualification','maximum_number_students','proposed_study_supervisor','qualification_study_supervisor','vacation_number_supervisor','proposed_study_leader','qualification_study_leader','vacation_number_leader','list_supervisor','file'];

    
     public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
