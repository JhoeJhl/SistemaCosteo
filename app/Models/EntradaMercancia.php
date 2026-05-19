<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EntradaMercancia extends Model
{
    use HasFactory;

    protected $fillable = [
        'proveedor_id',
        'producto_id',
        'cantidad',
        'precio',
        'es_compra_en_planta',
        'costos_adicionales',
    ];

    protected $casts = [
        'es_compra_en_planta' => 'boolean',
        'costos_adicionales' => 'array',
    ];

    // Relación con el Proveedor
    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }
    
    //Relacion con Productos
    public function producto(): BelongsTo
    {
        return $this->belongsTo(ProductoTerminado::class, 'producto_id');
    }
}