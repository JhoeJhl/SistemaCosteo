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

    //Funcion para tener una campaña activa 
    protected static function booted(): void
    {
        static::saving(function (Campania $campania) {
            
            if ($campania->is_active) {
                static::where('id', '!=', $campania->id)->update(['is_active' => false]);
            }
        });
    }

    // relacion con costo campania
    public function costosCampanias()
    {
        return $this->hasMany(CostoCampania::class, 'campania_id');
    }
}