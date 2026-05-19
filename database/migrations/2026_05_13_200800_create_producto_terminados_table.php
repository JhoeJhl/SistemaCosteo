<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ya la llamamos 'productos' directamente para dejar atrás el nombre viejo
        Schema::create('productos_terminados', function (Blueprint $table) {
            $table->id();

            // 1. EL CAMPO QUE FALTABA (Obligatorio para identificar qué es)
            $table->string('nombre')->comment('Ej: Pulpa Premium, Fruta en bruto, Bolsas 1kg');

            // 2. TIPO DE PRODUCTO (Opcional, pero muy útil para un ERP)
            $table->enum('tipo', ['materia_prima', 'producto_terminado', 'insumo'])->default('producto_terminado');

            // 3. ATRIBUTOS ESPECÍFICOS (Ahora son nullable porque un insumo no tiene "calidad de pulpa")
            $table->enum('calidad', ['18% Sol', '14-17% Sol', '<14% Sol'])->nullable();
            $table->decimal('tamanio_empaque_kg', 8, 2)->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};