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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('comunidad')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();

            // Campos operativos requeridos por el diseño
            $table->enum('tipo_terreno', ['propio', 'alquilado', 'comunitario'])->default('propio');
            $table->boolean('entrega_en_planta')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};
