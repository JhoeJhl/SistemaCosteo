<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = [
        'nombre',
        'comunidad',
        'telefono',
        'direccion',
        'tipo_terreno',
        'entrega_en_planta',
    ];

    protected function casts(): array
    {
        return [
            'entrega_en_planta' => 'boolean',
        ];
    }
}