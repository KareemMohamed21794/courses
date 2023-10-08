<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App;
class Department extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = ['display_name'];

    protected $fillable = [
        'name_ar', 'name_en','active'
    ];

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function getDisplayNameAttribute()
    {
        if (App::isLocale('ar')) {
            return "{$this->name_ar}";
        }else{
            return "{$this->name_en}";
        }
    }
}
