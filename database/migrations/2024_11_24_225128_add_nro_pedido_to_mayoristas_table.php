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
            $table->integer('nroPedido')->default(0); // Ajusta 'nombre' si deseas colocarlo en otro lugar.
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mayoristas', function (Blueprint $table) {
            $table->dropColumn('nroPedido');
        });
    }
};
