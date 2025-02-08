<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRegistration extends Model
{
    use HasFactory;
    protected $fillable = ['admin_id','first_name','father_name','grandfather_name','family_name','full_name','birth_date','birth_place','mobile_number','home_number','national_id','nationality','parents_status','education_level','blood_type','hobbies','health_condition','health_condition_type','city','area','street','nearest_teacher','building_number','guardian_name','division','guardian_phone','guardian_phone_2','guardian_job','relative_relation','guardian_place_work','guardian_email','identifier_name','identifier_phone','notes','text_note','type','year'];


     public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
