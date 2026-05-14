<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campania extends Model
{
    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        // El evento "saving" se ejecuta justo antes de crear o actualizar en la BD
        static::saving(function (Campania $campania) {
            
            // Si la campaña que estamos guardando viene como ACTIVA...
            if ($campania->is_active) {
                // buscamos todas las demás campañas y las desactivamos
                static::where('id', '!=', $campania->id)->update(['is_active' => false]);
            }
        });
    }
}