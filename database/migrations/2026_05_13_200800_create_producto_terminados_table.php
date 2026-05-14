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
        Schema::create('producto_terminados', function (Blueprint $table) {
            $table->id();


            $table->enum('calidad', ['18% Sol', '14-17% Sol', '<14% Sol']); // calidad de pulpa

            $table->decimal('tamanio_empaque_kg', 8, 2); // tamaño

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_terminados');
    }
};
