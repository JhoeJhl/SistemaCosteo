<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoTerminado extends Model
{
    protected $fillable = [
        'nombre',
        'tipo',
        'calidad',
        'tamanio_empaque_kg',
    ];

    protected function casts(): array
    {
        return
            [
                'tamanio_empaque_kg' => 'decimal:2', // redondeo a 2 decimales
            ];
    }
}
