<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizingStudieSeparate extends Model
{
    use HasFactory;
    protected $table = 'organizing_studie_separates';
    protected $fillable = ['organizing_studies_id','day','date'];

    
     public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
