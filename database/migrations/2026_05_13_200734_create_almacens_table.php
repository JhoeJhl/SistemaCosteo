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
        Schema::create('almacens', function (Blueprint $table) {
            $table->id();

            $table->string('codigo_almacen')->unique()->comment('Código único generado');
            $table->string('nombre');
            $table->string('estado')->default('activo')->comment('Puede ser activo, inactivo o uno personalizado');
            $table->string('tipo')->comment('MP o PT');
            $table->text('descripcion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almacenes');
    }
};
