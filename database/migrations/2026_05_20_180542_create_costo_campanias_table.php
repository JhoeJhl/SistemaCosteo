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
        Schema::create('costo_campanias', function (Blueprint $table) {
            $table->id();

            // Relacion con tabla campañas
            $table->foreignId('campania_id')->constrained('campanias')->cascadeOnDelete();

            // El costo si es fijo o indirecto
            $table->enum('clasificacion', ['Fijo', 'Indirecto']);

            $table->enum('categoria', [
                'Personal',
                'Servicios',
                'Certificaciones',
                'Fungibles',
                'Administrativo',
                'Depreciación',
                'Mantenimiento'
            ]);

            $table->string('descripcion');
            $table->decimal('monto', 10, 2);
            $table->boolean('esta_pagado')->default(false);
            $table->date('fecha_registro');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costo_campanias');
    }
};
