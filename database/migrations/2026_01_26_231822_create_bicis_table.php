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
        Schema::create('bicis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')
                ->cascadeOnDelete();

            $table->string('color')->nullable();
            $table->foreignId('tipo_id')->nullable();   // ej: MTB, Ruta, Urbana
            $table->foreignId('marca_id')->nullable();  // marca de la bici

            $table->string('detalles')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bicis');
    }
};
