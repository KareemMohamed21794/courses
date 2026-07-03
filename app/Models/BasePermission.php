<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasePermission extends Model
{
    use HasFactory;

    const MODELS = [
        'Admin',
        'Department',
        'Permission',
        'Position',
    ];

    protected $table = 'base_permissions';
    protected $fillable = ['admin_id', 'position_id', 'model_class', 'permission'];

    public $timestamps = false;
}
