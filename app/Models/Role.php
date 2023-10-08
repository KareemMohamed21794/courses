<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasFactory;
    protected $table = 'roles';

    protected $fillable = ['name', 'guard_name'];

    const EVENTS = [
        0 => 'role_created',
        1 => 'role_updated',
        2 => 'role_deleted'
    ];
}
