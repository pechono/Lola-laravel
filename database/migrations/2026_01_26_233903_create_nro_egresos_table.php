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
        Schema::create('nro_egresos', function (Blueprint $table) {
    $table->id();

    $table->string('numeroEgreso')->unique(); // ej: EGR-000001
    $table->float('monto')->default(0);
    $table->text('detalles')->nullable();
    $table->integer('mecanico_id');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nro_egresos');
    }
};
