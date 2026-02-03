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
        Schema::create('egreso_bicis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ingreso_bici_id')
                ->constrained('ingreso_bicis')
                ->cascadeOnDelete();

            $table->foreignId('articulo_id')
                ->constrained('articulos');

            $table->float('cantidad')->default(1);
            $table->float('precio_inicial');
            $table->float('precio_final');

            $table->string('nro_egreso')->nullable();
            $table->text('detalles')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egreso_bicis');
    }
};
