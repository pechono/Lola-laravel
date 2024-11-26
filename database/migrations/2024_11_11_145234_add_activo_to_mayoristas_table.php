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
        Schema::table('mayoristas', function (Blueprint $table) {
            $table->boolean('activo')->default(true); // Añade el campo 'activo' como booleano con valor predeterminado 'true'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mayoristas', function (Blueprint $table) {
            $table->dropColumn('activo'); // Elimina el campo 'activo' si se revierte la migración
        });
    }
};
