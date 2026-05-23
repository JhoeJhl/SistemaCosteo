<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Campania;
use App\Models\Almacen;
use App\Models\Proveedor;
use App\Models\ProductoTerminado;


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
        // aumento de stock al registrar nueva entrada
        static::created(function ($entrada) {
            $entrada->producto->increment('stock', $entrada->cantidad);
        });

        // Calcular la diferencia y ajustar
        static::updated(function ($entrada) {
            $diferencia = $entrada->cantidad - $entrada->getOriginal('cantidad');
            
            if ($diferencia != 0) {
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
        return $this->belongsTo(ProductoTerminado::class, 'producto_terminados_id');
    }

    //Relacion con campaña
    public function campana(): BelongsTo
    {
        return $this->belongsTo(Campania::class, 'campania_id');
    }

    //Relacion con almacen
    public function almacen(): BelongsTo
    {
        return $this->belongsTo(Almacen::class);
    }
}
