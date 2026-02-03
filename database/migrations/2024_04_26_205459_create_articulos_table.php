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
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
                        $table->string('codigo', 20)->nullable();
            $table->string('articulo');
            $table->integer('categoria_id');
            $table->string('presentacion');
            $table->integer('unidad_id');
            $table->string('descuento');
            $table->string('unidadVenta');
            $table->float('precioI');
            $table->float('precioF');
            $table->string('caducidad');
            $table->string('detalles')->nullable();
            $table->boolean('suelto');
            $table->boolean('activo');
                                    $table->string('qr_code')->nullable(); // o después de otro campo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos');
    }
};
