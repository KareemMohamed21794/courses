<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App;
class Position extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = ['display_name'];

    protected $fillable = [
        'department_id','name_ar', 'name_en', 'description_ar', 'description_en','active'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function admin()
    {
        return $this->hasMany(Admin::class);
    }

    public function getDisplayNameAttribute()
    {
        if (App::isLocale('ar')) {
            return "{$this->name_ar}";
        }else{
            return "{$this->name_en}";
        }
    }

    public function permissions()
    {
        return $this->hasMany(BasePermission::class, 'position_id', 'id');
    }

    public function hasPermission($modelClass, $permission)
    {
        return $this->hasMany(BasePermission::class, 'position_id', 'id')
            ->where('model_class', '=', $modelClass)
            ->where('permissions', '=',$permission);
    }
}
