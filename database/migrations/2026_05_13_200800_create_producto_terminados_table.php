<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        
        Schema::create('producto_terminados', function (Blueprint $table) {
            $table->id();


            $table->string('nombre')->comment('Ej: Pulpa Premium, Fruta en bruto, Bolsas 1kg');
            $table->enum('tipo', ['materia_prima', 'producto_terminado', 'insumo'])->default('producto_terminado');
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