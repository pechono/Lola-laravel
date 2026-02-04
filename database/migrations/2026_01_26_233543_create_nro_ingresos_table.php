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
        Schema::create('nro_ingresos', function (Blueprint $table) {
        $table->id();

        $table->text('detalles')->nullable();
        $table->date('fecha_retiro')->nullable();


        $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nro_ingresos');
    }
};
