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
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            $table->string('oferta');
            $table->string('detalles')->nullable();
            $table->float('precio');
            $table->time('hora')->nullable(); // Cambié 'tiempo' a 'hora' para el tipo TIME
            $table->date('fecha')->nullable(); // Cambié 'tiempo' a 'fecha' para el tipo DATE
            $table->integer('articulo_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ofertas');
    }
};
