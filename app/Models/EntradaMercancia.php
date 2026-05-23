<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use app\Models\Campania;
use app\Models\Almacen;

class EntradaMercancia extends Model
{
    use HasFactory;

    protected $fillable = [
        'campana_id',
        'producto_id',
        'proveedor_id',
        'almacen_id',
        'cantidad',
        'unidad_medida',
        'costo_unitario',
        'costo_total',
        'fecha_ingreso',
        'observaciones',
    ];

    protected $casts = [
        'cantidad' => 'decimal:2',
        'costo_unitario' => 'decimal:2',
        'costo_total' => 'decimal:2',
        'fecha_ingreso' => 'date',
    ];

    // actualizacion de stock
    protected static function booted()
    {
        // Al registrar una nueva entrada -> Suma al stock
        static::created(function ($entrada) {
            $entrada->producto->increment('stock', $entrada->cantidad);
        });

        // Al editar un registro -> Calcula la diferencia y ajusta
        static::updated(function ($entrada) {
            $diferencia = $entrada->cantidad - $entrada->getOriginal('cantidad');
            
            if ($diferencia != 0) {
                // Si la diferencia es positiva, suma. Si es negativa, resta automáticamente.
                $entrada->producto->increment('stock', $diferencia);
            }
        });

        // Al eliminar un registro (por error) -> Resta el stock que había sumado
        static::deleted(function ($entrada) {
            $entrada->producto->decrement('stock', $entrada->cantidad);
        });
    }


    // ----------------RELACIONES-------------------

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

    //Relacion con campaña
    public function campana(): BelongsTo
    {
        return $this->belongsTo(Campania::class, 'campana_id');
    }

    //Relacion con almacen
    public function almacen(): BelongsTo
    {
        return $this->belongsTo(Almacen::class);
    }
}
