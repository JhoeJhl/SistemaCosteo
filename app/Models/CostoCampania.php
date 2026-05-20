<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CostoCampania extends Model
{
    use HasFactory;

    protected $fillable = [
        'campania_id',
        'clasificacion',
        'categoria',
        'descripcion',
        'monto',
        'esta_pagado',
        'fecha_registro',
    ];

    protected $casts = [
        'esta_pagado' => 'boolean',
        'fecha_registro' => 'date',
        'monto' => 'decimal:2',
    ];

    // Conexión de vuelta al modelo de la campaña
    public function campania(): BelongsTo
    {
        return $this->belongsTo(Campania::class, 'campania_id');
    }
}
