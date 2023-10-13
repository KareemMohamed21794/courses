<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class QualificationLeader extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['admin_id','leader_name','current_qualification','study_history_mqw','place_study_mqw','organizer_mqw','rent_date_mqw','rent_number_mqw','study_history_qw','place_study_qw','organizer_qw','rent_date_qw','rent_number_qw','study_history_mqt','place_study_mqt','organizer_mqt','rent_date_mqt','rent_number_mqt','study_history_qt','place_study_qt','organizer_qt','rent_date_qt','rent_number_qt'];
}
