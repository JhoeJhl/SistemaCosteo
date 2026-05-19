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

            // Relación vital: ¿A quién le compramos?
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedors')->nullOnDelete();

            // El producto a jalar (Te haré una pregunta sobre esto más abajo)
            $table->foreignId('producto_id')->nullable();

            // Datos principales de la entrada
            $table->decimal('cantidad', 10, 2)->comment('Cantidad que entra (Kg, Unidades, etc)');
            $table->decimal('precio', 10, 2)->comment('Precio unitario de compra');

            // Check de compra en planta
            $table->boolean('es_compra_en_planta')->default(false);

            // Costos adicionales (Se guarda como JSON para permitir múltiples costos por entrada)
            $table->json('costos_adicionales')->nullable();

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
