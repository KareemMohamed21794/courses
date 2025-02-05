<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class GroupLeader extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['admin_id','first_name','father_name','grandfather_name','family_name','birth_date','birth_place','job','scout','specialization_scout','year_scout','place_scout','vacation_scout','note_scout','academic','specialization_academic','year_academic','college','work_place','phone','Job_title','city','area','street','building_number','nearest_teacher','home_phone','marital_status','phone_comunication','email','fax','mailbox','city_comunication','zip_code'];


     public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
