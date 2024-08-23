<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizingStudieFile extends Model
{
    use HasFactory;
    protected $table = 'organizing_studie_files';
    protected $fillable = ['organizing_studies_id','file'];

  
}
