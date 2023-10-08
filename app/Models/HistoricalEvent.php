<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricalEvent extends Model
{
    use HasFactory;

    protected $table = 'historical_events';

    protected $fillable = [
        'name',
        'affect_model',
        'affect_id',
        'action',
        'by_model', // Model::class
        'by_id',
        'log', // explain
        'extra_info',
    ];

    protected $casts = [
        'extra_info' => 'array'
    ];
}
