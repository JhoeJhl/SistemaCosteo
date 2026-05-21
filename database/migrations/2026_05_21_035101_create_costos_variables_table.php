<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('costos_variables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campania_id')
                  ->constrained('campanias')
                  ->cascadeOnDelete()
                  ->comment('Enlace al módulo maestro de campaña');
            
            $table->string('categoria');
            $table->string('unidad_costo');
            $table->string('descripcion');
            $table->decimal('monto', 12, 2);
            $table->date('fecha_registro');
            $table->text('observaciones')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('costos_variables');
    }
};