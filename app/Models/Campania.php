<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campania extends Model
{
    protected $table = 'campanias';

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'activa',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'activa' => 'boolean',
    ];
}
