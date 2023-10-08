<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ClientPermission extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'main_client_id', 'sub_client_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
