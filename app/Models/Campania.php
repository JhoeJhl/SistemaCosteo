<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CostoCampania;
use App\Models\CostosVariables;


class Campania extends Model
{
    protected $fillable = [
        'codigo_campania',
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

    // Funcion para tener una campaña activa 
    protected static function booted(): void
    {
        static::saving(function (Campania $campania) {
            
            if ($campania->is_active) {
                static::where('id', '!=', $campania->id)->update(['is_active' => false]);
            }
        });
    }

    // relacion con costo campania (M1)
    public function costoCampanias()
    {
        return $this->hasMany(CostoCampania::class, 'campania_id');
    }

    // relacion con costos variables (M2)
    public function costosVariables()
    {
    
        return $this->hasMany(CostosVariables::class, 'campania_id');
    }
}