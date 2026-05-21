<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Campania;

class CostosVariables extends Model
{
    use HasFactory;

    protected $fillable = [
        'campania_id',
        'categoria',
        'unidad_costo',
        'descripcion',
        'monto',
        'fecha_registro',
        'observaciones',
    ];

    protected $casts = [
        'fecha_registro' => 'date',
        'monto' => 'decimal:2',
    ];

    public function campania()
    {
        return $this->belongsTo(Campania::class, 'campania_id');
    }
}