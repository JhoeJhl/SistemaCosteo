<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entrada_mercancias', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->foreignId('campana_id')->constrained('campanias')->restrictOnDelete();
            $table->foreignId('producto_terminados_id')->constrained('productos')->restrictOnDelete();
            $table->foreignId('proveedors_id')->constrained('proveedores')->restrictOnDelete();
            $table->foreignId('almacens_id')->constrained('almacenes')->restrictOnDelete();

            // Cantidades y Medidas
            $table->decimal('cantidad', 12, 2);
            $table->string('unidad_medida', 50);

            // Finanzas
            $table->decimal('costo_unitario', 12, 2);
            $table->decimal('costo_total', 12, 2);

            // Trazabilidad
            $table->date('fecha_ingreso');
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada_mercancias');
    }
};
