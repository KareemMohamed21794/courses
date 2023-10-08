<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['position_id', 'permission_name'];

    protected $table = 'permissions';

    const EVENTS = [
        0 => 'permission_created',
        1 => 'permission_updated',
        2 => 'permission_deleted'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }



}
